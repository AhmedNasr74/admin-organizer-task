<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'name',
        'description',
        'status',
        'organizer_id',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function organizer(){
        return $this->belongsTo(Organizer::class);
    }

}
