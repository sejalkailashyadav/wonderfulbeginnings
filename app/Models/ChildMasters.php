<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildMasters extends Model
{
    use HasFactory;
    protected $table = 'child_masters';
    protected $primaryKey = 'child_id';

    protected $fillable = [
        'center_id',
        'program_id',
        'child_first_name',
        'child_last_name',
        'parent_first_name',
        'parent_last_name',
        'child_dob',
        'parent_email',
        'parent_mobile',
        'institution_number',
        'transit_number',
        'account_number',
        'emergency_contact_name',
        'emergency_contact_number',
        'admission_date',
        'active_status',
        'end_date',
        'special_notes',
        'registration_fees_paid',
        'number_of_days'
    ];
    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }

    public function program()
    {
         return $this->belongsTo(\App\Models\ProgramMasters::class, 'program_id');
    }

    
    public function fee()
    {
        return $this->hasOne(FeesMasters::class, 'child_id', 'child_id');
    }


}
