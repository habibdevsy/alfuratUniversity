<?php

namespace App\Controller;

use App\Entity\CollegeEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CollegeType;
use App\Repository\CollegeEntityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CollegeController extends AbstractController
{

    public function __construct(FlashyNotifier $flashy)
{
    $this->flashy = $flashy;
}

     /**
     * @Route("/college", name="createCollege")
     * @param Request $request
     * @return JsonResponse
     */
    public function createCollege(Request $request):Response
    {
        $data = new CollegeEntity();
        $form = $this->createForm(CollegeType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
            // return $this->redirectToRoute('task_success');
            $this->flashy->success('Event created!');
        }
        return $this->render('college/index.html.twig', [
       
            'form' => $form->createView(),
        ]);
    }
}
