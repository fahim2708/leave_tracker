<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $guarded = [];  
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'  => 'datetime',
        'applied_on' => 'datetime'


    ];

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }
}
