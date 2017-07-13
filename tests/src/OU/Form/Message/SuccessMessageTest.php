<?php

namespace OU\Form\Message;

use OU\Form\MessageLevel;
use PHPUnit\Framework\TestCase;

class SuccessMessageTest extends TestCase
{
    public function testMessage()
    {
        $message = new SuccessMessage('Test Message');
        $this->assertEquals('Test Message', $message);
        $this->assertEquals(MessageLevel::SUCCESS, $message->level);
    }
}
