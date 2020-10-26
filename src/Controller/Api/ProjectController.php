<?php

namespace App\Controller\Api;

use App\Entity\Project;
use App\Form\Model\ProjectDto;
use App\Service\Auth;
use App\Service\ProjectFormProcessor;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/projects")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function getProjectsAction(UserManager $userManager)
    {
        $user = Auth::verify($userManager);
        return $user->getProjects();
    }
    /**
     * @Rest\Post(path="/project/create")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function createProjectAction(
        Request $request,
        ProjectFormProcessor $projectFormProcessor,
        UserManager $userManager
    ) {
        $user = Auth::verify($userManager);
        return ($projectFormProcessor)($request, $user);
    }
}
