<?php

namespace OU\Form;

use OU\Form\Message\DangerMessage;
use OU\Form\Message\SuccessMessage;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Rules;

class FormTest extends TestCase
{
    public function testValidation()
    {
        $form = new Form();
        $form->email = new Field('test@email.com');
        $form->email->addRule(new Rules\Email(), new DangerMessage('Geçersiz e-posta adresi.'));
        $form->password = new Field('12345678');
        $form->password->addRule(new Rules\Length(8), new DangerMessage('En az 8 karakter olmalı.'));
        $this->assertTrue($form->validate());
        $this->assertNull($form->email->message);
        $this->assertNull($form->password->message);
    }

    public function testDontBreakValidation()
    {
        $emailMessage = new DangerMessage('Geçersiz e-posta adresi.');
        $passwordMessage = new DangerMessage('En az 8 karakter olmalı.');
        $form = new Form();
        $form->email = new Field();
        $form->email->addRule(new Rules\Email(), $emailMessage);
        $form->password = new Field();
        $form->password->addRule(new Rules\Length(8), $passwordMessage);
        $this->assertFalse($form->validate());
        $this->assertEquals($form->email->message, $emailMessage);
        $this->assertEquals($form->password->message, $passwordMessage);
    }

    public function testMessages()
    {
        $message1 = new SuccessMessage('İşlem başarıyla gerçekleşti 1.');
        $message2 = new SuccessMessage('İşlem başarıyla gerçekleşti 2.');
        $form = new Form();
        $form->addMessage($message1);
        $form->addMessage($message2);
        $this->assertEquals($form->getMessages()[0], $message1);
        $this->assertEquals($form->getMessages()[1], $message2);
    }
}
