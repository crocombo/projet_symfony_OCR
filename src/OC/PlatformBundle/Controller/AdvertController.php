<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    # Custom page test ****************
    public function testAction()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Advert:index_test.html.twig', array(
            'nom' => 'Cro',
            'prenom' => 'Combo'
        ))
    ;

    return new Response($content);
    }


    # Page index **********************
    public function indexAction()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Advert:index.html.twig', array(
            'nom' => 'Cro',
            'prenom' => 'Combo'
        ))
        ;

        return new Response($content);
    }


    # Page view ***********************
    public function viewAction($id)
    {
        return new Response("Affichage de l'annonce d'id => ".$id);
    }


    # Page view ***********************
    public function viewSlugAction($slug, $year, $format)
    {
        return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format.".");
    }


    public function indexAction()
    {
        // On veut avoir l'URL de l'annonce d'id 5.
        $url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => 5)    // 2e argument : les valeurs des paramètres
        );
        // $url vaut « /platform/advert/5 »
        
        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
    }


}
