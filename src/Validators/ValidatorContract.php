<?php
namespace Practice\BlogPost\Validators;

interface ValidatorContract
{
    /**
     * returns errors if any
     *
     * @return array
     */
    public function errors(): array;

    public function validate(): bool;

    public function rules(): array;
}