<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramCreates extends Model
{
    use HasFactory;

    protected $table = 'program_creates';
    protected $primaryKey = 'prog_master_id';
    protected $fillable = ['prog_master_id', 'program_name'];

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }
    public function programMaster()
    {
        return $this->belongsTo(ProgramMasters::class, 'prog_master_id', 'prog_master_id');
    }

}
