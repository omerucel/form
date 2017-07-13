<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;
use PHPUnit\Framework\TestCase;

class DangerMessageTest extends TestCase
{
    public function testMessage()
    {
        $message = new DangerMessage('Test Message');
        $this->assertEquals('Test Message', $message);
        $this->assertEquals(MessageLevel::DANGER, $message->level);
    }
}
