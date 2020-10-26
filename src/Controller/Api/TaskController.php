<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\ProjectManager;
use App\Service\TaskFormProcessor;
use App\Service\Token;
use App\Service\TokenRsa;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/task/{projectid}")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(
        int $projectid,
        UserManager $userManager,
        ProjectManager $projectManager
    ) {
        $user = Auth::verify($userManager);

        $project = $projectManager->findById($projectid);
        if ($project && $user->existProject($project)) {
            return $project->getTasks();
        } else {
            return ["error" => "Invalid project"];
        }
    }
    /**
     * @Rest\Post(path="/task")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        UserManager $userManager,
        TaskFormProcessor $taskFormProcessor,
        Request $request
    ) {
        $user = Auth::verify($userManager);
        return ($taskFormProcessor)($request, $user);
    }
}
