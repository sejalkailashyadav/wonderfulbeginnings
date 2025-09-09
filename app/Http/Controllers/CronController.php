<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrentChildMaster;
use Carbon\Carbon;

class CronController extends Controller
{
    public function archiveWithdrawals()
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $children = CurrentChildMaster::where('status', 2)
            ->whereDate('withdrawal_date', '<=', $today)
            ->get();

        foreach ($children as $child) {
            $child->status = 3; // Archive
            $child->save();
        }

        return response()->json([
            'message' => 'Checked and Updated ' . $children->count() . ' records to Archive.',
            'data' => $children
        ]);
    }
    
      // Fetch children with status 2 (Withdrawal) whose withdrawal_date is in a previous month
    //  public function archiveWithdrawals()
    // {
    //     $today = Carbon::now();
    //     $firstDayOfMonth = $today->copy()->startOfMonth();

    //     // Fetch children with status 2 (Withdrawal) whose withdrawal_date is in a previous month
    //     $children = CurrentChildMaster::where('status', 2)
    //         ->whereDate('withdrawal_date', '<', $firstDayOfMonth)
    //         ->get();

    //     $updatedCount = 0;

    //     foreach ($children as $child) {
    //         $child->status = 3; // Archive
    //         $child->save();
    //         $updatedCount++;
    //     }

    //     return response()->json([
    //         'message' => 'Checked and Updated ' . $updatedCount . ' records to Archive.',
    //         'timestamp' => $today->toDateTimeString(),
    //     ]);
    // }
    
}

?>