<?php

namespace App;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, minMessage: 'Le nom doit faire {{ limit }} caractère(s) minimum.')]
    private $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Regex('/@yopmail.com$/', match: false, message: 'Adresse Yopmail interdite.')]
    private $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 15)]
    private $message;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
