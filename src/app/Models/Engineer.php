<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    use HasFactory;

    protected $fillable = [
        'age',
        'gender',
        'user_id',
        'introduction',
        'github_url',
        'facebook_url',
        'qiita_url'
    ]; 

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    
}
