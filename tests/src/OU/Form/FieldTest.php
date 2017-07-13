<?php

namespace OU\Form;

use OU\Form\Message\DangerMessage;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Rules;

class FieldTest extends TestCase
{
    public function testBreakValidation()
    {
        $firstMessage = new DangerMessage('Boş bırakılmamalı.');
        $secondMessage = new DangerMessage('En az 5 karakter olmalı.');
        $field = new Field();
        $field->addRule(new Rules\NotEmpty(), $firstMessage);
        $field->addRule(new Rules\Length(5), $secondMessage);
        $this->assertFalse($field->validate());
        $this->assertEquals($field->message, $firstMessage);
        $this->assertFalse($field->isValid);
    }

    public function testValidation()
    {
        $firstMessage = new DangerMessage('Boş bırakılmamalı.');
        $secondMessage = new DangerMessage('En az 5 karakter olmalı.');
        $field = new Field('12345');
        $field->addRule(new Rules\NotEmpty(), $firstMessage);
        $field->addRule(new Rules\Length(5), $secondMessage);
        $this->assertTrue($field->validate());
        $this->assertNull($field->message);
        $this->assertTrue($field->isValid);
    }

    public function testCustomRule()
    {
        $emailChecker = new class {
            public function isEmailUsing($email)
            {
                return false;
            }
        };
        $customRule = new class($emailChecker) extends Rules\AbstractRule {
            protected $emailChecker;

            public function __construct($emailChecker)
            {
                $this->emailChecker = $emailChecker;
            }

            public function validate($input)
            {
                return $this->emailChecker->isEmailUsing($input);
            }
        };
        $field = new Field('test');
        $field->addRule($customRule);
        $this->assertFalse($field->validate());
    }
}
