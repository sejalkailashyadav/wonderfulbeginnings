<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeesMasters extends Model
{
    use HasFactory;
    protected $table = 'fees_masters';
    protected $primaryKey = 'Fees_id';

    protected $fillable = [
        'center_id',
        'Program_id',
        'child_id',
        'number_of_days',
        'parent_fees',
        'CCFRI',
        'accb_received',
        'total_fees',
        'institution_number',
        'transit_number',
        'account_number',
    ];
public function center()
{
    return $this->belongsTo(\App\Models\CenterManagements::class, 'center_id');
}

public function program()
{
    return $this->belongsTo(\App\Models\ProgramMasters::class, 'Program_id');
}

public function child() 
{
    return $this->belongsTo(\App\Models\ChildMasters::class, 'child_id','child_id');
}

}
