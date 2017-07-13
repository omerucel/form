<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;

class InfoMessage extends Message
{
    /**
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message, MessageLevel::INFO);
    }
}
