<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\ProjectDto;
use App\Form\Model\UserDto;
use App\Form\Type\ProjectFormType;
use App\Form\Type\UserFormType;
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
        $update = $request->get("id");

        $projectDto = new ProjectDto();
        $form = $this->formFactory->create(
            ProjectFormType::class,
            $projectDto,
            ["method" => $update ? "patch" : "post"]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $project = null;
            if ($update) {
                $project = $this->projectManager->findById($update);
                if (!$user->existProject($project)) {
                    return ["error" => "Invalid project"];
                }
            } else {
                $project = $this->projectManager->create();
            }

            $project->setName($projectDto->name);
            $project->setDescription($projectDto->description);
            $project->setColor($projectDto->color);
            !$update && $project->setUser($user);

            $this->projectManager->save($project);
            return $project;
        }
        return $form;
    }
}
