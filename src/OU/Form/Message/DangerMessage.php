<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;

class DangerMessage extends Message
{
    /**
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message, MessageLevel::DANGER);
    }
}
