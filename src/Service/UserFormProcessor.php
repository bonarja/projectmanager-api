<?php

namespace App\Service;

use App\Form\Model\UserDto;
use App\Form\Type\UserFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserFormProcessor
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
        $userDto = new UserDto();
        $form = $this->formFactory->create(UserFormType::class, $userDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->userManager->exist($userDto)) {
                return ["error" => "Username en uso"];
            }

            $user = $this->userManager->createFromDto($userDto);
            return $this->userManager->save($user);
        }
        return $form;
    }
}
