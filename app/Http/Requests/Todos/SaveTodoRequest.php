<?php

namespace App\Http\Requests\Todos;

use Illuminate\Foundation\Http\FormRequest;

class SaveTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // For update request, make sure user can update the given todo
        if ($this->route('todo')) {
            return $this->user()->can('update', $this->route('todo'));
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}
