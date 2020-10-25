<?php

namespace App\Form\Model;

use App\Entity\User;

class UserDto
{
    public $name;
    public $username;
    public $categories;
    public $pass;

    public function __construct()
    {
        // iniciarlo como un arreglo
        $this->categories = [];
    }

    public static function createFromUser(User $user): self
    {
        $dto = new self();
        $dto->name = $user->getName();
        $dto->username = $user->getUsername();
        $dto->pass = $user->getPass();
        return $dto;
    }
}
