<?php
// src/OC/PlatformBundle/Controller/AdvertController.php
namespace OC\PlatformBundle\Controller;                             // Appartient a l'environement "OCPlatformBundle" (sont namesapce).


use Symfony\Bundle\FrameworkBundle\Controller\Controller;           // Notre contrôleur hérite du contrôleur de base de Symfony.
use Symfony\Component\HttpFoundation\Request;                       // Pour récupérer la requête depuis un contrôleur.
use Symfony\Component\HttpFoundation\Response;                      // Pour retourner une réponse depuis un contrôleur.
use Symfony\Component\HttpFoundation\RedirectResponse;              // Methode RedirectResponse permet les redirections.
use Symfony\Component\HttpFoundation\JsonResponse;                  // Methode permetant d'encoder grâce à la méthodejson_encode , puis définir le bonContent-Type 
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;      // Cette use donne accès à 1 méthode raccourcie pour générer des routes avec méthode generate UrlGeneratorInterface.


class AdvertController extends Controller
{
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  MENU
    public function menuAction($limit)
    {
                                                                                                            // On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
    $listAdverts = array(
        array('id' => 2, 'title' => 'Recherche développeur Symfony'),
        array('id' => 5, 'title' => 'Mission de webmaster'),
        array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('OCPlatformBundle:Advert:menu.html.twig', array('listAdverts' => $listAdverts)     // Tout l'intérêt est ici : le contrôleur passe les variables nécessaires au template !
        );
    }


////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  INDEX
    public function indexAction()
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

        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }


////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  VIEW
    public function viewAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }


////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  ADD
    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
          // Ici, on s'occupera de la création et de la gestion du formulaire

          $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

          // Puis on redirige vers la page de visualisation de cettte annonce
          return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }


////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  EDIT
    public function editAction($id, Request $request)
    {
        // ...

        $advert = array(
            'title'   => 'Recherche développpeur Symfony',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );

        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }


////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  DELETE
public function deleteAction($id)
{
    // Ici, on récupérera l'annonce correspondant à $id

    // Ici, on gérera la suppression de l'annonce en question

    return $this->render('OCPlatformBundle:Advert:delete.html.twig');
}


















///////////////////////////////////////////////////////////////////////////////////////      TEST PERSO


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




    # Action session -------------------------
    public function sessionAction($id, Request $request)
    {
        $session = $request->getSession();                                                      // Récupération de la session
        $userId = $session->get('user_id');                                                     // On récupère le contenu de la variable user_id
        $session->set('user_id', 91);                                                           // On définit une nouvelle valeur pour cette variable user_id

        return new Response("<body>Je suis une page de test, je n'ai rien à dire</body>");      // On renvoye une réponse
    }




    # Action viewSlug -------------------------
    public function viewSlugAction($slug, $year, $format)
    {
        return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format.".");
    }




    # Action myRoute -------------------------
    public function myRouteAction($id)                   // Générer une URL prête à être utilisée, dans notre cas de l'annonce d'id 5 : 
    {
        // On veut avoir l'URL de l'annonce d'id 5.
        $url = $this->get('router')->generate(
            'oc_platform_myRoute',                      // 1e argument : le nom de la route
            array('id' => $id),                         // 2e argument : les valeurs des paramètres                                         // /projet_symfony_OCR/web/app_dev.php/platform/myRoute/5     /myRoute/5
            UrlGeneratorInterface::ABSOLUTE_URL         // 3e argument : générer une URL absolue (ex : pour envoyez un e-mail par exemple)  // http://localhost/projet_symfony_OCR/web/app_dev.php/platform
        );
       // Méthode longue : $url = $this->get('router')->generate('oc_platform_home');
       // Méthode courte : $url = $this->generateUrl('oc_platform_home');

       // $url vaut « /platform/advert/5 »
        return new Response("L'URL de l'annonce d'id ".$id." est : <br>".$url);
    }




    # test page avec response
    public function testResponseAction($id)
    {
    $response = new Response();                                         // On crée la réponse sans lui donner de contenu pour le moment
       $response->setContent("Ceci est une page d'erreur 404");         // On définit le contenu
       $response->setStatusCode(Response::HTTP_NOT_FOUND);              // On définit le code HTTP à « Not Found » (erreur 404)
       return $response;// On retourne la réponse
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

































