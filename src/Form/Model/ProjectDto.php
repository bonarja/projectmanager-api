<?php

namespace App\Form\Model;


class ProjectDto
{
    public $name;
    public $color;
    public $userId;
    public $tasks;

    public function __construct()
    {
        $this->tasks = [];
    }
}