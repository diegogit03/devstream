<?php

namespace DevStream\Models;

class Stream extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'record_id',
        'views',
        'image_filename',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
