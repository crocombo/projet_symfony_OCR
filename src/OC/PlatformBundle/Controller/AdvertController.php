<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class AdvertController extends Controller
{
    # Action test -------------------------
    public function testAction()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Advert:index_test.html.twig', array(
            'nom' => 'Cro',
            'prenom' => 'Combo'
        ))
    ;
    return new Response($content);
    }


    # Action index -------------------------
    public function indexAction()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Advert:index.html.twig', array(
            'nom' => 'Cro',
            'prenom' => 'Combo'
        ))
        ;
        return new Response($content);
    }


    # Action view -------------------------
    public function viewAction($id)
    {
        return new Response("Affichage de l'annonce d'id => ".$id);
    }


    # Action viewSlug -------------------------
    public function viewSlugAction($slug, $year, $format)
    {
        return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format.".");
    }


    # Action myRoute -------------------------
    public function myRouteAction($id)                // Générer une URL prête à être utilisée, dans notre cas de l'annonce d'id 5 : 
    {
        // On veut avoir l'URL de l'annonce d'id 5.
        $url = $this->get('router')->generate(
            'oc_platform_myRoute',                // 1e argument : le nom de la route
            array('id' => $id),                     // 2e argument : les valeurs des paramètres                                         // /projet_symfony_OCR/web/app_dev.php/platform/myRoute/5     /myRoute/5
            UrlGeneratorInterface::ABSOLUTE_URL   // 3e argument : générer une URL absolue (ex : pour envoyez un e-mail par exemple)  // http://localhost/projet_symfony_OCR/web/app_dev.php/platform
        );
       // Méthode longue : $url = $this->get('router')->generate('oc_platform_home');
       // Méthode courte : $url = $this->generateUrl('oc_platform_home');

       // $url vaut « /platform/advert/5 »
        return new Response("L'URL de l'annonce d'id ".$id." est : <br>".$url);

    }


}
