<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    private $em;
    private $taskRepository;

    public function __construct(EntityManagerInterface $em, TaskRepository $taskRepository)
    {
        $this->em = $em;
        $this->taskRepository = $taskRepository;
    }
    public function create(): Task
    {
        return new Task();
    }
    public function save(Task $task): Task
    {
        $this->em->persist($task);
        $this->em->flush();
        return $task;
    }
    public function findById($id): Task
    {
        return $this->taskRepository->find($id);;
    }
}
