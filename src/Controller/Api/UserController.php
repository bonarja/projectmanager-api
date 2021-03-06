<?php

namespace App\Controller\Api;


use App\Service\Auth;
use App\Service\UserFormProcessor;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractFOSRestController
{
    // /**
    //  * @Rest\Get(path="/user")
    //  * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
    //  */
    // public function getAction(UserRepository $userRepository)
    // {
    //     return $userRepository->findAll();
    // }
    /**
     * @Rest\Post(path="/user")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        Request $request,
        UserFormProcessor $userFormProcessor
    ) {
        return ($userFormProcessor)($request);
    }
    /**
     * @Rest\Delete(path="/user")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function deleteAction(Request $request, UserManager $userManager)
    {
        $user = Auth::verify($userManager);
        $userManager->delete($user);

        return ["success" => true];
    }
    /**
     * @Rest\Patch(path="/user")
     * @Rest\View(serializerGroups={"userUpdate"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateAction(Request $request, UserManager $userManager)
    {
        $user = Auth::verify($userManager);
        $userName = $request->get("name");

        if (!$userName) {
            return ["error", "require name"];
        }
        $user->setName($userName);
        return $userManager->save($user);
    }
}
