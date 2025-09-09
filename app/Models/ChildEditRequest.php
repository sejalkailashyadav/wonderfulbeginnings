<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CurrentChildMaster;

class ChildEditRequest extends Model
{
    protected $table = 'child_edit_requests';

    protected $fillable = ['child_id', 'proposed_data', 'status'];

    protected $casts = [
        'proposed_data' => 'array',
    ];

    public function child()
    {
        return $this->belongsTo(CurrentChildMaster::class, 'child_id', 'child_id');
    }
}
