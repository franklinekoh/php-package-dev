<?php

namespace Practice\BlogPost\Validators;

class Validator
{

    protected array $request = [];
    protected array $errors = [];

    public function __construct(array $request){
        $this->request = $request;
    }

    public function rules(): array
    {
        return [];
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        foreach ($this->request as $key => $request){
            $rules = $this->rules();

            if (array_key_exists($key, $rules)){
                $rule = $rules[$key];
                $rule = explode('|', $rule);
                foreach ($rule as $innerRule){
                    $innerRule = explode(':', $innerRule);
                    if (count($innerRule) === 2){
                        $this->{$innerRule[0]}($key, $request, $innerRule[1]);
                    }
                    if (count($innerRule) === 1){

                        $this->{$innerRule[0]}($key, $request);
                    }
                }
            }else{
                $this->errors[] = "The rule for $key does not exist";
            }
        }

        if (count($this->errors)  > 0){
            return false;
        }
        return true;
    }


    private function array($key, $value){
        if (!is_array($value)){
            $this->errors[] = "The value ${key} must be an array";
        }
    }

    private function required($key, $value){

        if (is_null($value)){
                $this->errors[] = "The value ${key} is required";
        }

    }

    private function max($key, $value, $count){
            switch (gettype($value)){
                case 'string':
                    if (strlen($value) > $count){
                        $this->errors[] = "The value $key must have characters less than or equal $count";
                    }
                    break;
                case 'array':
                    if (count($value) > $count){
                        $this->errors[] = "The value $key must have array elements less than or equal $count";
                    }
                    break;
                default;
            }
    }

    private function min($key, $value, $count){
        switch (gettype($value)){
            case 'string':
                if (strlen($value) < $count){
                    $this->errors[] = "The value $key must have characters greater than or equal $count";
                }
                break;
            case 'array':
                if (count($value) < $count){
                    $this->errors[] = "The value $key must have array elements greater than or equal $count";
                }
                break;
            default;
        }
    }

    private function int($key, $value){
        if (gettype($value) != 'integer'){
            $this->errors[] = "The value ${key} must be an integer";
        }
    }

    private function string($key, $value){
        if (gettype($value) != 'string'){
            $this->errors[] = "The value ${key} must be a string";
        }
    }

    private function bool($key, $value){
        if (gettype($value) == 'integer') {
            if ($value == 1 || $value == 0){
                return true;
            }
            $this->errors[] = "The value ${key} must be a boolean";
        }

        if (gettype($value) != 'boolean') {
            $this->errors[] = "The value ${key} must be a boolean";
        }
        return false;
    }
}