<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\Model\UserDto;
use App\Form\Type\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/user")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(UserRepository $userRepository)
    {
        return $userRepository->findAll();
    }
    /**
     * @Rest\Post(path="/user")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        Request $request,
        EntityManagerInterface $em,
        UserRepository $userRepository
    ) {
        $userDto = new UserDto();
        $form = $this->createForm(UserFormType::class, $userDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($userRepository->exitsUser($userDto)) {
                return ["error" => "Username en uso"];
            }

            $user = new User();
            $user->setName($userDto->name);
            $user->setUsername($userDto->username);
            $user->setPass($userDto->pass);
            $em->persist($user);
            $em->flush();
            return $user;
        }
    }
}
