<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\TaskDto;
use App\Form\Type\TaskFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskFormProcessor
{
    private $taskManager;
    private $formFactory;
    private $projectManager;

    public function __construct(
        TaskManager $taskManager,
        FormFactoryInterface $formFactory,
        ProjectManager $projectManager
    ) {
        $this->taskManager = $taskManager;
        $this->formFactory = $formFactory;
        $this->projectManager = $projectManager;
    }

    public function  __invoke(Request $request, User $user)
    {
        $update = $request->get("id");

        $taskDto = new TaskDto();
        $form = $this->formFactory->create(
            TaskFormType::class,
            $taskDto,
            ["method" => $update ? "patch" : "post"]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $update ? $this->taskManager->findById($update) : $this->taskManager->create();


            $task->setName($taskDto->name);
            $task->setDescription($taskDto->description);
            $task->setFinish($taskDto->finish);

            $project = $this->projectManager->findById($taskDto->project);


            if ($project && $user->existProject($project)) {
                !$update && $task->setProject($project);
                return $this->taskManager->save($task);
            } else {
                return ["error" => "Invalid project"];
            }
        }
        return $form;
    }
}
