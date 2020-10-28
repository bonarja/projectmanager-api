<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\ProjectManager;
use App\Service\TaskFormProcessor;
use App\Service\TaskManager;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/tasks")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function tasksAction(
        UserManager $userManager,
        ProjectManager $projectManager,
        Request $request
    ) {
        $projectid = $request->get("project");
        $user = Auth::verify($userManager);
        $project = $projectManager->findById($projectid);
        if ($project && $user->existProject($project)) {
            return $project->getTasks();
        } else {
            return ["error" => "Invalid project"];
        }
    }
    /**
     * @Rest\Post(path="/task/create")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function createTaskAction(
        UserManager $userManager,
        TaskFormProcessor $taskFormProcessor,
        Request $request
    ) {
        $user = Auth::verify($userManager);
        return ($taskFormProcessor)($request, $user);
    }
    /**
     * @Rest\Delete(path="/task")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function deleteAction(Request $request, UserManager $userManager, TaskManager $taskManager)
    {
        $user = Auth::verify($userManager);
        $task =  $taskManager->findById($request->get("task"));
        if ($user->getTask($task)) {
            $taskManager->delete($task);
            return ["success" => true];
        }
        return ["error" => "error al eliminar la tarea"];
    }
    /**
     * @Rest\Patch(path="/task")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateAction(
        UserManager $userManager,
        TaskFormProcessor $taskFormProcessor,
        Request $request
    ) {
        $user = Auth::verify($userManager);
        return ($taskFormProcessor)($request, $user);
    }
}
