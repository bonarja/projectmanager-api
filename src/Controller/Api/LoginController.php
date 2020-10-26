<?php

namespace App\Controller\Api;

use App\Service\Auth;
use App\Service\UserLoginFormProcessor;
use App\Service\UserManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/login")
     * @Rest\View(serializerGroups={"userlogin"}, serializerEnableMaxDepthChecks=true)
     */
    public function loginAction(Request $request, UserLoginFormProcessor $userLoginFormProcessor)
    {
        return ($userLoginFormProcessor)($request);
    }
    /**
     * @Rest\Post(path="/auth")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function authAction(UserManager $userManager)
    {

        return Auth::verify($userManager);
    }
}
