<?php

namespace App;

use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    #[Assert\NotBlank(message: 'Cette valeur est obligatoire.')]
    public $name;

    #[Assert\NotBlank]
    #[Assert\Length(min: 10)]
    public $description;
}
