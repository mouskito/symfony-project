<?php

namespace CarBundle\Controller;


use CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{

   /**
     * @Route("/")
     */
    public function addAction(Request $request)
    {
    	$car = new Car();
    	$form = $this->createFormBuilder($car)
        ->add('marque')
        ->add('save', SubmitType::class)
        ->getForm();
		
		$form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
      	$em->persist($car);
      	$em->flush();

        return $this->render('CarBundle:Default:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
