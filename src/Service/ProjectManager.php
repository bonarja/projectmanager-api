<?php

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjectManager
{
    private $em;
    private $projectRepository;

    public function __construct(EntityManagerInterface $em, ProjectRepository $projectRepository)
    {
        $this->em = $em;
        $this->projectRepository = $projectRepository;
    }
    public function create(): Project
    {
        return new Project();
    }
    public function save(Project $project): Project
    {
        $this->em->persist($project);
        $this->em->flush();
        return $project;
    }

    public function findById($id): ?Project
    {
        return $this->projectRepository->find($id);
    }
}
