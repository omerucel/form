<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;
use PHPUnit\Framework\TestCase;

class WarningMessageTest extends TestCase
{
    public function testMessage()
    {
        $message = new WarningMessage('Test Message');
        $this->assertEquals('Test Message', $message);
        $this->assertEquals(MessageLevel::WARNING, $message->level);
    }
}
