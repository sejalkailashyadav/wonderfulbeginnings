<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $fillable = [
        'child_names',
        'child_dobs',
        'parent_names',
        'parent_contact',
        'requested_start_date',
        'sibling_group',
        'weekend_spot',
        'care_type',
        'preferred_location',
        'notes',
        'status',
    ];

    protected $casts = [
        'sibling_group' => 'boolean',
        'weekend_spot' => 'boolean',
        'requested_start_date' => 'date',
    ];
}