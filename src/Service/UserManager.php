<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\UserDto;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    private $em;
    private $userRepository;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }
    public function create(): User
    {
        return new User();
    }
    public function save(User $user): User
    {
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    public function exist(UserDto $userDto)
    {
        return $this->userRepository->findOneBy(["username" => $userDto->username]);
    }
    public function createFromDto(UserDto $userDto): User
    {
        $user = new User();
        $user->setName($userDto->name);
        $user->setUsername($userDto->username);
        $user->setPass($userDto->pass);
        return $user;
    }
    public function findById($id): User
    {
        return $this->userRepository->find($id);;
    }
    public function findByUsername(string $username): ?User
    {
        $user = $this->userRepository->findOneBy(["username" => $username]);
        if (!$user) return null;
        return $user;
    }
    public function delete($user)
    {
        $this->em->remove($user);
        $this->em->flush($user);
    }
}
