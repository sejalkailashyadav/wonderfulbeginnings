<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    use HasFactory;

    protected $table = 'employee_masters';
    protected $primaryKey = 'emp_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'email',
        'resume',
        'designation',
        'ece_license',
        'ece_license_expiry',
        'primary_location',
        'first_aid_license',
        'first_aid_expiry',
        'police_clearance',
        'police_clearance_expiry',
        'immunization_record',
        'covid_vaccine_record',
        'start_date',
        'probation_end_period',
        'three_reference_letter',
        'signed_handbook',
        'income_tax_forms',
        'legal_work_doc',
    ];
}

?>