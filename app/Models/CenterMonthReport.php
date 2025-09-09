<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CenterManagements;
use App\Models\CurrentChildMasterl;

class CenterMonthReport extends Model
{
    public $timestamps = false;
    protected $table = 'center_month_reports';
    protected $fillable = ['center_id', 'report_month'];

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }
    
    public function child()
    {
        return $this->belongsTo(CurrentChildMaster::class, 'child_id', 'child_id');
    }
    
    
    public function monthlyReports()
    {
        return $this->hasMany(ChildMonthlyReport::class, 'child_id', 'child_id');
    }


}
