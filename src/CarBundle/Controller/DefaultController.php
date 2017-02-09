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
    * @Route("/car/add/", name="add")
    * 
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

    /**
    * @Route("/car/list/", name="list")
    * 
    */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository("CarBundle:Car")->findAll();
        
        return $this->render('CarBundle:Default:list.html.twig',array("cars"=>$marque));
    }

    /**
    * @Route("/car/show/{id}", name="show")
    * 
    */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository("CarBundle:Car")->findById($id);

        return $this->render('CarBundle:Default:show.html.twig',array("cars"=>$marque));
    }
}
