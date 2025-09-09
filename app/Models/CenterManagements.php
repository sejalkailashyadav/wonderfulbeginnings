<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CenterManagements extends Model
{
    use HasFactory;
    protected $table = 'center_managments';
    protected $primaryKey = 'center_id';
    public $timestamps = false;

    protected $fillable = [
        'center_name',
        'center_address',
        'center_email',
        'center_email',
        'phone_number',
        'license_number',
        'g_number',
        'facility_number',
        'licensing_officer_name',
        'licensing_officer_email',
        'licensing_officer_mobile',
        'business_license_doc',
        'facility_license_doc',
        'incorporation_doc',
        'other_file_doc',
        'number_of_classrooms',
         'ccof', 
         'inspection_reports'
    ];

    public function programs()
    {
        return $this->hasMany(ProgramMasters::class, 'center_id');
    }
    public function children()
    {
        return $this->hasMany(ChildMasters::class, 'center_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassMaster::class, 'center_id', 'center_id');
    }
}
