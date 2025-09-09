<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CenterManagements;
use App\Models\CurrentChildMaster;
use App\Models\ChildMasters;
use App\Models\ClassMaster;
use App\Models\FeesMasters;
use App\Models\CurrentFeesMaster;

class CurrentChildMaster extends Model
{
    protected $table = 'current_child_masters';
    protected $primaryKey = 'child_id';
    public $timestamps = true;

    protected $fillable = [
        'center_id','fees_id','class_id',
        'child_first_name','child_last_name',
        'parent_first_name','parent_last_name',
        'child_dob','parent_email','parent_mobile',
        'institution_number','transit_number','account_number',
        'emergency_contact_name','emergency_contact_number',
        'emergency_contact_relations','emergency_contact_name2',
        'emergency_contact_number2','emergency_contact_relation2',
        'emergency_contact_name3','emergency_contact_number3','emergency_contact_relation3',
        'admission_date','end_date','special_notes','no_of_days',
        'registration_fees_paid','issibling', 'child_picture',
         'status','withdrawal_date', 'withdrawal_note','withdrawal_requeste_date',
        'custody_agreement','health_card','other_file_doc','sibling_child_id'
    ];

    public function center() { return $this->belongsTo(CenterManagements::class, 'center_id', 'center_id'); }
    public function class() { return $this->belongsTo(ClassMaster::class, 'class_id', 'class_id'); }
    public function fee()   { return $this->belongsTo(CurrentFeesMaster::class, 'fees_id', 'id'); }
    public function getStatusLabelAttribute()
        {
            return match($this->status) 
            {
                0 => 'Review',
                1 => 'Active',
                2 => 'Withdrawal',
                3 => 'Archive',
                default => 'Unknown',
            };
        }
}
