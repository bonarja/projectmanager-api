<?php

namespace App\Controller\Api;

use App\Repository\ProjectRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProjectController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/project")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(ProjectRepository $projectRepository)
    {
        return $projectRepository->findAll();
    }
}
