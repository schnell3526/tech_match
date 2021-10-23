<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message'];
    
    public function send_user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function receive_user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
