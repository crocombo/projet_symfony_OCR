<?php
// src/OC/CoreBundle/Controller/CoreController.php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;                       // Pour récupérer la requête depuis un contrôleur.
use Symfony\Component\HttpFoundation\Response;                      // Pour retourner une réponse depuis un contrôleur.
use Symfony\Component\HttpFoundation\RedirectResponse;              // Methode RedirectResponse permet les redirections.
use Symfony\Component\HttpFoundation\JsonResponse;                  // Methode permetant d'encoder grâce à la méthodejson_encode , puis définir le bonContent-Type 
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;      // Cette use donne accès à 1 méthode raccourcie pour générer des routes avec méthode generate UrlGeneratorInterface.




class CoreController extends Controller
{

    # ---------------------------------------------------------------------------------------INDEX
#    public function indexPersoAction()
#    {
#        $content = $this->get('templating')->render('OCCoreBundle:Default:index.html.twig', array(
#            'msg1' => 'Activité 1',
#            'msg2' => 'CoreBundle'
#        ))
#    ;
#    return new Response($content);
#    }

    # ---------------------------------------------------------------------------------------INDEX (idem mais sans $content)
    public function indexPersoAction()
    {


        // Notre liste d'annonce en dur
        $listAdverts = array(
                array(
                    'title'   => 'Recherche développpeur Symfony',
                    'id'      => 1,
                    'author'  => 'Alexandre',
                    'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                    'date'    => new \Datetime()),
                array(
                    'title'   => 'Mission de webmaster',
                    'id'      => 2,
                    'author'  => 'Hugo',
                    'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                    'date'    => new \Datetime()),
                array(
                    'title'   => 'Offre de stage webdesigner',
                    'id'      => 3,
                    'author'  => 'Mathieu',
                    'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                    'date'    => new \Datetime())
        );

        return $this->render('OCCoreBundle:Coreviews:index.html.twig', array(
            'listAdverts' => $listAdverts,
            'msg1' => 'Activité  <span style="color: red;">#1</span>',
            'msg2' => 'CoreBundle'
        ));
        
        
    }





    # ---------------------------------------------------------------------------------------CONTACT
    public function contactAction(Request $request)
    {
    
        //variable de session pour le message flashbag:
        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'Page de contact non disponible<br>merci de revenir plus tard');
        // Puis on redirige vers la page de visualisation de cette annonce
        
        return $this->redirectToRoute('oc_core_homepage');      

        #return $this->render('OCCoreBundle:Coreviews:contact.html.twig');
        
    }










}
