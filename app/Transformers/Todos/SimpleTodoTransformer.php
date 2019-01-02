<?php

namespace App\Transformers\Todos;

use App\Transformers\Transformer;

class SimpleTodoTransformer extends Transformer
{

    /**
     * Transform a single object
     *
     * @param $object
     *
     * @return mixed
     */
    public function transform($object)
    {
        return (object) collect($object)->only([
            'id',
            'title',
            'due_at',
        ])->merge([
            'user' => $object->user(),
        ]);
    }
}
