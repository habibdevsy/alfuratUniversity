<?php

namespace App\Controller;

use App\Entity\SubjectEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SubjectType;
use App\Repository\SubjectEntityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class SubjectController extends AbstractController
{

    private $paginator ;
    private $subjectEntityRepository ;

    public function __construct( PaginatorInterface $paginator, SubjectEntityRepository $subjectEntityRepository)
    {      
        $this->paginator = $paginator;        
        $this->subjectEntityRepository = $subjectEntityRepository;        
    }

    /**
     * @Route("/subject", name="createSubject")
     * @param Request $request
     * @return JsonResponse
     */
    public function createSubject(Request $request):Response
    {
        $data = new SubjectEntity();
        $form = $this->createForm(SubjectType::class, $data);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
            return $this->redirectToRoute('show_subjects');
        }
        return $this->render('subject/index.html.twig', [
       
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("subject/{id}/edit", name="subject_edit")
     */
    public function edit(Request $request, SubjectEntity $subject): Response
    {
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subject);
            $entityManager->flush();
            return $this->redirectToRoute('show_subjects');
        }
           
        return $this->render('subject_edit/index.html.twig',[
            'editform' => $form->createView() 
        ]);
    }
    
    /**
     * @Route("showsubjects", name="show_subjects")
     */
    public function index(Request $request): Response
    {
        $subjects = $this->paginator->paginate($this->subjectEntityRepository->findAll(),
        $request->query->getInt('page',1),
        5);
        return $this->render('show_subjects/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }

      /**
     * @Route("/searchsubject", name="searchsubject")
     */
    public function searchAction(Request $request):Response
    {
             $searchTerm = $request->query->get('search');     
           
            $this->getDoctrine()->getManager();
            $results = $this->paginator->paginate($this->subjectEntityRepository->findBy(['subjectName'=>$searchTerm]),
            $request->query->getInt('page',1),
            5);
             return $this->render('show_subjects/index.html.twig', [
                'subjects' => $results,
            ]);
   }
}
