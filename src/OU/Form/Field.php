<?php

namespace OU\Form;

use OU\Form\Message\Message;
use Respect\Validation\Validatable;

class Field
{
    public $value;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var bool
     */
    public $isValid = true;

    /**
     * @var array
     */
    private $rules = [];

    /**
     * @param $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @param Validatable $rule
     * @param Message $message
     */
    public function addRule(Validatable $rule, Message $message = null)
    {
        $this->rules[] = [$rule, $message];
    }

    /**
     * @return bool
     */
    public function validate()
    {
        /**
         * @var Validatable $validatable
         */
        foreach ($this->rules as $rule) {
            $validatable = $rule[0];
            if ($validatable->validate($this->value) == false) {
                $this->isValid = false;
                $this->message = $rule[1];
                break;
            }
        }
        return $this->isValid;
    }
}
