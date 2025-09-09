<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrentChildMaster;
use Carbon\Carbon;

class CronController extends Controller
{
    public function archiveWithdrawals()
    {
        $today = Carbon::now();

        $children = CurrentChildMaster::where('status', 2)
            ->whereDate('withdrawal_date', '<=', $today->startOfMonth())
            ->get();

        if ($children->isEmpty()) {
            return response()->json(['message' => 'No children to archive.']);
        }

        foreach ($children as $child) {
            $child->status = 3; // Archive
            $child->save();
        }

        return response()->json(['message' => 'Archived ' . $children->count() . ' children.']);
    }
}

?>