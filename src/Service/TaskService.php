<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;
use App\Repository\TaskRepository;

class TaskService {
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly TaskRepository $taskRepository)
    {}

    public function save(Task $task){
        if($task->getTitle() != "" && $task->getContent()){
            if(!$this->taskRepository->findOneBy(['title'=> $task->getTitle()])){
               // si il faut donner un status $task->setStatus("false");
                $this->em->persist($task);
                $this->em->flush();
            }
            else {
                throw new \Exception("La tâche existe déjà", 400);
            }
        }
        else {
            throw new \Exception("Les champs ne sont pas remplis", 400);

        }
    }

    public function getAll(){
            if($this->taskRepository->findAll()){
                return $this->taskRepository->findAll();
            }
            else {
                throw new \Exception("Problemos, aucun comptes trouvés", 400);
            }
    }


}