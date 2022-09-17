<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * 
     */
    protected $table = 'tasks';

    /**
     * 
     */
    protected $fillable = ['task', 'deadline', 'user_id'];

    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
