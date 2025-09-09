<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CenterManagements;
use Illuminate\Notifications\Notifiable; 

class UserManagements extends Model
{  
    use HasFactory,Notifiable;
    protected $table = 'user_managemnts';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_name',
        'password',
        'user_type',
        'user_status',
        'center_id',
    ];
     protected $hidden = [
        'password',
    ];
        public function routeNotificationForMail($notification)
    {
        return 'sejalyadav122@gmail.com'; 
    }

    public function center()
    {
        return $this->belongsTo(CenterManagements::class, 'center_id');
    }
    
    
}
