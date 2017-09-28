<?php

// src/OC/PlatformBundle/Controller/NextController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NextController extends Controller
{

	#permet d'afficher page /next1
	public function indexAction()
	{
	$content = $this->get('templating')->render('OCPlatformBundle:Next:index1.html.twig', array(
		'nom' => 'Cro',
		'prenom' => 'Combo'
	))
	;

	return new Response($content);
	}

	
	#permet d'afficher page /next2
	public function testAction()
	{
	$content = $this->get('templating')->render('OCPlatformBundle:Next:index2.html.twig', array(
		'nom' => 'Cro',
		'prenom' => 'Combo'
	))
	;

	return new Response($content);
	}



	#permet d'afficher page /next3
	public function porscheAction()
	{
	$content = $this->get('templating')->render('OCPlatformBundle:Next:index3.html.twig', array(
		'nom' => 'Cro',
		'prenom' => 'Combo'
	))
	;

	return new Response($content);
	}








}
