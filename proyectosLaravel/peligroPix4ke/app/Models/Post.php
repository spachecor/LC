<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    /**
     * RELACION ENTRE USER Y POST
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
