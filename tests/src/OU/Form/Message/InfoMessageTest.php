<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;
use PHPUnit\Framework\TestCase;

class InfoMessageTest extends TestCase
{
    public function testMessage()
    {
        $message = new InfoMessage('Test Message');
        $this->assertEquals('Test Message', $message);
        $this->assertEquals(MessageLevel::INFO, $message->level);
    }
}
