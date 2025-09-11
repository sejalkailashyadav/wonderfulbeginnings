<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildMonthlyReport extends Model
{
    public $timestamps = false;
    protected $casts = [
        'notes' => 'array',
    ];

    protected $fillable = [
        'child_id', 'center_id', 'class_id',
        'month', 'monthly_fee', 'ccfri','notes', 'accb' ,'total','status','institution_number','transit_number','account_number'];
    
    public function child()
{
    return $this->belongsTo(\App\Models\CurrentChildMaster::class, 'child_id', 'child_id');
}

}
