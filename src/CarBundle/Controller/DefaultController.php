<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{
    /**
     * @Route("/car", name="carhome")
     */
    public function indexAction(Request $request)
    {

        $carRepo = $this->getDoctrine()->getRepository('CarBundle:Car');
        $cars = $carRepo->findCarsWithDetails();

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('CarBundle:Default:index.html.twig',
            [
                'cars' => $cars,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/car/{id}", name="cardetail")
     */
    public function showAction($id)
    {
        $carRepo = $this->getDoctrine()->getRepository('CarBundle:Car');
        $car = $carRepo->findCarWithDetailsById($id);

        return $this->render('CarBundle:Default:detail.html.twig', ['car' => $car ]);
    }
}
