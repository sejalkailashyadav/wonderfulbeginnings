<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagerMasters extends Model
{
    use HasFactory;
    protected $table = 'manager_masters';
    protected $primaryKey = 'manager_id';
    protected $fillable = ['manager_name', 'manager_email', 'manager_num', 'center_id'];

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }
}
