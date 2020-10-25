<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

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
}
