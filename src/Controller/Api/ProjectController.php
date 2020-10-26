<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\ProjectFormProcessor;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/project")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(UserManager $userManager)
    {
        $user = Auth::verify($userManager);
        return $user->getProjects();
    }
    /**
     * @Rest\Post(path="/project")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        Request $request,
        ProjectFormProcessor $projectFormProcessor,
        UserManager $userManager
    ) {
        $user = Auth::verify($userManager);
        return ($projectFormProcessor)($request, $user);
    }
}
