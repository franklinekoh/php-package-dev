<?php
namespace Practice\BlogPost\Validators;

class AddPostValidator extends Validator implements ValidatorContract
{

    public function rules(): array
    {
        return [
            'id' => 'required|int',
            'title' => 'required|string',
            'image' => 'string',
            'body' => 'required|string|min:20|max:1000',
            'author' => 'required|string',
            'hidden' => 'required|bool',
            'comments' => 'array'
        ];
    }
}