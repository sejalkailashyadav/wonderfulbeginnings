<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_id';
    protected $table = 'class_masters';
    protected $fillable = [
        'class_name',
        'amount_of_children',
        'total_currently_enrolled',
        'classroom_schedules',
        'center_id',
    ];

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }
     public function children()
    {
        return $this->hasMany(CurrentChildMaster::class, 'class_id', 'class_id');
    }
    public function classes()
    {
        return $this->hasMany(ClassMaster::class, 'center_id', 'center_id');
    }
}
