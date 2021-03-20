<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organizer extends Authenticatable
{
    use HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /* Relations */
    public function events(){
        return $this->hasMany(Event::class);
    }

    //mutator
    public function setPasswordAttribute( $value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
