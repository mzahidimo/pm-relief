<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = ['name','father_name','address','cnic','cell','district','tehsil','uc','user_id'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
