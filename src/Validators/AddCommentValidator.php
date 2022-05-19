<?php

namespace Practice\BlogPost\Validators;

class AddCommentValidator extends Validator implements ValidatorContract
{

    public function rules(): array
    {
        return [
            'id' => 'required|int',
            'author' => 'required|string',
            'body' => 'required|string'
        ];
    }
}