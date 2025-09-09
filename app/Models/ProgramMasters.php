<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramMasters extends Model
{
    use HasFactory;

    protected $table = 'program_masters';
    protected $primaryKey = 'program_id';

    protected $fillable = [
        'prog_master_id',
        'center_id',
        'program_fees',
        'ccfri',
        'accb',
        'parent_fees',
        'number_of_days',
    ];

    public function centers()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id', 'center_id');
    }

    public function programDetails()
    {
        return $this->belongsTo(ProgramCreates::class, 'prog_master_id', 'prog_master_id');
    }

    public function parentProgram()
    {
        return $this->belongsTo(ProgramMasters::class, 'program_id', 'program_id');
    }

    public function children()
    {
        return $this->hasMany(ChildMasters::class, 'program_id');
    }

    public function programCreate()
    {
        return $this->belongsTo(ProgramCreates::class, 'prog_master_id');
    }

}
