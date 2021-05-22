<?php

namespace App\Controller;

use App\Entity\GradeeEntity;
use App\Entity\UserEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\GradeeType;
use App\Repository\UserEntityRepository;
use App\Repository\GradeeEntityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class GradeeController extends AbstractController
{

    private $gradeeEntityRepository ;
    public function __construct(GradeeEntityRepository $gradeeEntityRepository, PaginatorInterface $paginator)
    {
        $this->gradeeEntityRepository = $gradeeEntityRepository;
        $this->paginator = $paginator;      
       
    }  
    /**
     * @Route("/grade", name="createGrade")
     * @param Request $request
     * @return JsonResponse
     */
    public function createGrade(Request $request):Response
    {
        $user = new GradeeEntity();
        $form = $this->createForm(GradeeType::class, $user);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->savePassedFiled($data);
            $data->setCreateDate(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
        }
        return $this->render('gradee/index.html.twig', [
       
            'form' => $form->createView(),
        ]);
    }

    public function savePassedFiled($data)
    {
        $passingGrade = $data->getSubject()->getPassingGrade();
        $grade = $data->getGrade();
        if ($grade >= $passingGrade ) {
            $data->setPassedFiled(true);
            }
        else{
            $data->setPassedFiled(false);
            }
    }

     /**
     * @Route("gradeshow", name="show_grades")
     */
    public function index(Request $request): Response
    {
        $users = $this->paginator->paginate($this->gradeeEntityRepository->findAll(),
        $request->query->getInt('page',1),
        5);
        return $this->render('show_grade/index.html.twig', [
            'grades' => $users,
        ]);
    }

    /**
     * @Route("grade/{id}", name="grade_edit")
     */
    public function edit(Request $request, GradeeEntity $grade): Response
    {
        $form = $this->createForm(GradeeType::class, $grade);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grade);
            $entityManager->flush();
            return $this->redirectToRoute('show_grades');
        }
           
        return $this->render('grade_edit/index.html.twig',[
            'editform' => $form->createView() 
        ]);
    }

    public function getUserByUserName($userName)
    {
       return $this->gradeeEntityRepository->getUserByUserName($userName);

    }

    /**
     * @Route("/searchgrade", name="searchgrade")
     */
    public function searchAction(Request $request):Response
    { 
       $searchTerm = $request->query->get('search');     
           
        $em = $this->getDoctrine()->getManager();
        $results = $this->paginator->paginate($this->getUserByUserName($searchTerm),
        $request->query->getInt('page',1),
            5);
        return $this->render('show_grade/index.html.twig', [
                'grades' => $results,
            ]);
        }
}
