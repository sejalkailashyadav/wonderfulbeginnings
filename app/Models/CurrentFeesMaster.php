<?php
namespace App\Models;
use App\Models\CurrentFeesMaster;
use App\Models\CenterManagements;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassMaster;

class CurrentFeesMaster extends Model
{
    protected $table = 'current_fees_masters'; 
    //  protected $primaryKey = 'class_id';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'center_id',
        'class_id',
        'fees_name',
        'monthly_fees',
        'ccfri'
    ];

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }

    public function getTotalAttribute()
    {
        return $this->monthly_fees - $this->ccfri;
    }
     public function children()
    {
        return $this->hasMany(CurrentChildMaster::class, 'fees_id', 'id');
    }
    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id', 'class_id');
    }
}
?>