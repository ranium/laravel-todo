<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * Attributes that can be mass assigned (filled)
     *
     * @var array
     */
    public $fillable = [
        'user_id',
        'title',
        'due_at',
        'description',
    ];

    /**
     * Date fields
     *
     * @var array
     */
    public $dates = ['due_at'];
}
