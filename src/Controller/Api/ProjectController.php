<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\ProjectFormProcessor;
use App\Service\ProjectManager;
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
    /**
     * @Rest\Delete(path="/project")
     * @Rest\View(serializerGroups={"project"}, serializerEnableMaxDepthChecks=true)
     */
    public function deleteAction(Request $request, ProjectManager $projectManager, UserManager $userManager)
    {
        $user = Auth::verify($userManager);
        $project = $projectManager->findById($request->get("project"));
        if ($project && $user->existProject($project)) {
            $projectManager->delete($project);
            return ["success" => true];
        }
        return ["error" => "No se ha podido eliminar el proyecto"];
    }
    /**
     * @Rest\Patch(path="/project")
     * @Rest\View(serializerGroups={"projectUpdate"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateAction(
        Request $request,
        ProjectFormProcessor $projectFormProcessor,
        UserManager $userManager
    ) {
        $user = Auth::verify($userManager);
        return ($projectFormProcessor)($request, $user);
    }
}
