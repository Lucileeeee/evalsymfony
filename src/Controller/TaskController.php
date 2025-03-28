<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskRepository;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;



final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly EntityManagerInterface $em
        ){
    }

    #[Route('/task', name: 'app_tasks')]
    public function showAllTasks(): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $this->taskRepository->findAll(),
        ]);
    }

    #[Route('/task/add', name: 'app_task_add')]
    public function addOneCategory(Request $request): Response
    {
        $cat = new Task();
        $form = $this->createForm(TaskType::class, $cat);
        $form->handleRequest($request);
        $msg ="";
        $status ="";
        if($form->isSubmitted()){
            try{
                $this->em->persist($task);
                $this->em->flush();
                $msg= "Toudo Buene";
                $status="succes";
            }catch (\Exception $e){
               $msg= "erreur";
               $status="danger";
            }
           
        }
        $this->addFlash($status, $msg);
        return $this->render('task/addTask.html.twig',
             ['form'=>$form]);
    }
}