<?php

// src/OC/PlatformBundle/Controller/NextController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NextController extends Controller
{
  public function indexAction()
  {
    $content = $this->get('templating')->render('OCPlatformBundle:Next:index.html.twig', array(
		'nom' => 'Cro',
		'prenom' => 'Combo'
	))
	;
    
    return new Response($content);
  }
}
