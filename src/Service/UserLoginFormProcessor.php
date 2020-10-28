<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\UserLoginDto;
use App\Form\Type\UserLoginFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserLoginFormProcessor
{
    private $userManager;
    private $formFactory;

    public function __construct(
        UserManager $userManager,
        FormFactoryInterface $formFactory
    ) {
        $this->userManager = $userManager;
        $this->formFactory = $formFactory;
    }

    public function  __invoke(Request $request)
    {
        $userLoginDto = new UserLoginDto();
        $form = $this->formFactory->create(UserLoginFormType::class, $userLoginDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->userManager->findByUsername($userLoginDto->username);

            if (!$user) {
                return ["error" => "Invalid credentials"];
            }
            if (!Pass::verify($userLoginDto->pass, $user->getPass())) {
                return ["error" => "Invalid credentials"];
            }

            $token = Token::encode([
                "id" => $user->getId(),
                "name" => $user->getName()
            ]);

            return ["token" => $token, "name" => $user->getName()];
        }
        return $form;
    }
}
