<?php

namespace App;

use App\Traits\Presentable;
use App\Presenters\TodoPresenter;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use Presentable;

    /**
     * @var string
     */
    protected $presenter = TodoPresenter::class;

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
    public $dates = [
        'due_at',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
