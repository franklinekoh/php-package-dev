<?php

namespace Practice\BlogPost\Validators;

class EditPostValidator extends Validator implements ValidatorContract
{

    public function rules(): array
    {
        return [
            'id' => 'int|required',
            'title' => 'string|required',
            'image' => 'string|required',
            'body' => 'string|required',
            'author' => 'string|required',
            'hidden' => 'bool|required',
            'comments' => 'array|required'
        ];
    }
}