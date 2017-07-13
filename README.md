[![Build Status](https://secure.travis-ci.org/omerucel/form.png)](http://travis-ci.org/omerucel/form)

# About

This library provides clean and an easy solution for form validation process. It's using 
[respect/validation](https://github.com/Respect/Validation) package for validation part.

# Composer

```yaml
{
    "require": {
        "omerucel/form": "1.0.0"
    }
}
```

# Usage

There's two options to use. First way is to extend **OU\Form\Form** class and it is clean way to use this library.

```php
<?php

namespace {

    use OU\Form\Field;
    use OU\Form\Message\DangerMessage;
    use OU\Form\Message\SuccessMessage;
    use Respect\Validation\Rules;
    use Symfony\Component\HttpFoundation\Request;

    $request = Request::createFromGlobals();
    $form = new RegistrationForm($request);
    if ($form->validate()) {
        // Complete form action
        $form->setCompleted(true);
        $form->addMessage(new SuccessMessage('User created.'));
    } else {
        $form->addMessage(new DangerMessage('Please try again.'));
    }
    
    class RegistrationForm extends OU\Form\Form
    {
        public $email;
        public $password;
        
        public function __construct(Request $request)
        {
            $this->email = new Field($request->get('email'));
            $this->email->addRule(new Rules\Email(), new DangerMessage('Invalid email address.'));
            $this->password = new Field($request->get('password'));
            $this->password->addRule(new Rules\NotEmpty(), new DangerMessage('Password is empty.'));
            $this->password->addRule(new Rules\Length(8), new DangerMessage('Password is too short.'));
        }
    }
}

```

Another way is using **OU\Form\Form** class directly.

```php
<?php

namespace {

    use OU\Form\Form;
    use OU\Form\Field;
    use OU\Form\Message\DangerMessage;
    use OU\Form\Message\SuccessMessage;
    use Respect\Validation\Rules;
    use Symfony\Component\HttpFoundation\Request;

    $request = Request::createFromGlobals();
    $form = new Form();
    $form->email = new Field($request->get('email'));
    $form->email->addRule(new Rules\Email(), new DangerMessage('Invalid email address.'));
    $form->password = new Field($request->get('password'));
    $form->password->addRule(new Rules\NotEmpty(), new DangerMessage('Password is empty.'));
    $form->password->addRule(new Rules\Length(8), new DangerMessage('Password is too short.'));
    
    if ($form->validate()) {
        $form->setCompleted(true);
        $form->addMessage(new SuccessMessage('User created.'));
    } else {
        $form->addMessage(new DangerMessage('Please try again.'));
    }
}

``` 

You can extend
**Respect\Validation\Rules\AbstractRule** class or implement **Respect\Validation\Validatable** interface to create
your own validation rule. Please check it's documentation for this.