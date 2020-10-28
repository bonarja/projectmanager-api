<?php

namespace App\Form\Model;


class TaskDto
{
    public $id;
    public $name;
    public $description;
    public $finish;
    public $project;

    public function __construct()
    {
        $this->finish = 0;
    }
}
