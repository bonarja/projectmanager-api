<?php

namespace App\Form\Model;


class ProjectDto
{
    public $name;
    public $color;
    public $description;
    public $tasks;

    public function __construct()
    {
        $this->tasks = [];
    }
}
