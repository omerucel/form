<?php

namespace OU\Form;

use OU\Form\Message\Message;

class Form
{
    private $messages = [];
    private $completed = false;

    /**
     * @param Message $message
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function validate()
    {
        /**
         * @var Field $field
         */
        $isValid = true;
        foreach ($this as $field) {
            if ($field instanceof Field && $field->validate() == false) {
                $isValid = false;
            }
        }
        return $isValid;
    }

    /**
     * @var bool $completed
     */
    public function setCompleted($completed = true)
    {
        $this->completed = $completed;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }
}
