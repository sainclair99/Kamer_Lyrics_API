<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'artist_user';

    protected $fillable = ['user_id','artist_id'];

    protected $hidden = ['created_at','updated_at'];

}
