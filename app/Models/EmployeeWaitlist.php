<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWaitlist extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'mobile_number',
        'email',
        'reference',
        'resume',
        'expected_start_date',
    ];
}
?>