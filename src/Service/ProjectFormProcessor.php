<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\ProjectDto;
use App\Form\Type\ProjectFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class ProjectFormProcessor
{
    private $formFactory;
    private $projectManager;

    public function __construct(
        FormFactoryInterface $formFactory,
        ProjectManager $projectManager
    ) {
        $this->formFactory = $formFactory;
        $this->projectManager = $projectManager;
    }

    public function  __invoke(Request $request, User $user)
    {
        $projectDto = new ProjectDto();
        $form = $this->formFactory->create(ProjectFormType::class, $projectDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project = $this->projectManager->create();
            $project->setName($projectDto->name);
            $project->setColor($projectDto->color);
            $project->setUser($user);

            $this->projectManager->save($project);
            return $project;
        }
        return $form;
    }
}
