<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;

class WarningMessage extends Message
{
    /**
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message, MessageLevel::WARNING);
    }
}
