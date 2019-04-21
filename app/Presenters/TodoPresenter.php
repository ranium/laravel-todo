<?php

namespace App\Presenters;

use Carbon\Carbon;

class TodoPresenter extends Presenter
{
    /**
     * Status presenter for Todo
     *
     * @return string Either completed or pending
     */
    public function status()
    {
        // If the completed_at field is not null then it means the todo is completed
        if ($this->entity->completed_at !== null) {
            return 'completed';
        }

        return 'pending';
    }
}
