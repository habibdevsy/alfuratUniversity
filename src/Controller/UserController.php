<?php

namespace App\Controller;
use App\AutoMapping;
use App\Entity\UserEntity;
use App\Entity\CollegeEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\SudentType;
use App\Form\SearchUserType;
use App\Form\UpdateType;
use App\Repository\UserEntityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use stdClass ;
use Knp\Component\Pager\PaginatorInterface;

class UserController extends AbstractController
{
    private $autoMapping ;
    private $paginator ;
    private $userEntityRepository ;

    public function __construct(AutoMapping $autoMapping, PaginatorInterface $paginator, userEntityRepository $userEntityRepository)
    {
        $this->autoMapping = $autoMapping;       
        $this->paginator = $paginator;        
        $this->userEntityRepository = $userEntityRepository;        
    }


    /**
     * @Route("/user", name="createUser")
     * @param Request $request
     * @return JsonResponse
     */
    public function userRegister(Request $request):Response
    {
        $data = new UserEntity();
       
        $form = $this->createForm(SudentType::class, $data);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setCreateDate(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
            return $this->redirectToRoute('show_users');
            
        } 
        return $this->render('user/index.html.twig', [
       
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("usershow", name="show_users")
     */
    public function index(Request $request): Response
    {
        $users = $this->paginator->paginate($this->userEntityRepository->findAll(),
        $request->query->getInt('page',1),
        5);
        return $this->render('show_users/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("user/{id}/edit", name="user_edit")
     */
    public function edit(Request $request, UserEntity $user): Response
    {
        $form = $this->createForm(SudentType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('show_users');
        }
           
        return $this->render('user_edit/index.html.twig',[
            'editform' => $form->createView() 
        ]);
    }

    public function getUserByUserName($userName)
    {
       return $this->getDoctrine()->getRepository(userEntityRepository::class)->findBy(['userName'=>$userName]);

    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request):Response
    {
             $searchTerm = $request->query->get('search');     
           
             $em = $this->getDoctrine()->getManager();
            $results = $this->paginator->paginate($this->userEntityRepository->findBy(['userName'=>$searchTerm]),
            $request->query->getInt('page',1),
            5);
             return $this->render('show_users/index.html.twig', [
                'users' => $results,
            ]);
   }             
}
