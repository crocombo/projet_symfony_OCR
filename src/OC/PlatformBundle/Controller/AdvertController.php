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
    public function viewAction($id, Request $request)                                           // Recupere $id et donne accès à la requête HTTP via $request donc on injecte la requête dans les arguments de la méthode
    {
        ########################## DECLARATION VAR
#        $response = new Response(json_encode(array('id' => $id)));                              // Créons nous-mêmes la réponse en JSON, grâce à la fonction json_encode()

#        $url = $this->get('router')->generate('oc_platform_home');                              // $url recoit oc_platform_home (voir le return avec RedirectResponse plus bas...)

#        $tag = $request->query->get('tag');                                                     // Récupère paramètre tag

        ########################## AFFICHAGE
        # Affichage sans template twig
#       return new Response("Affichage de l'annonce d'id => ".$id." avec le tag : ".$tag);      // Tester avec : http://localhost/projet_symfony_OCR/web/app_dev.php/platform/advert/100?tag=toze; Besoin d'ajouter ce: use Symfony\Component\HttpFoundation\Request;

        # Affichage avec template twig dont response incluse
#       return $this->get('templating')->renderResponse('OCPlatformBundle:Advert:view.html.twig', array('id'  => $id, 'tag' => $tag)

        # Affichage avec template twig dont response incluse & simplifié:
#       return $this->render('OCPlatformBundle:Advert:view.html.twig', array('id' => $id, 'tag' => $tag));


        ########################## REDIRECTION
        # Redirection methode 1 (longue):
#       return new RedirectResponse($url);                                                     // permet de rediriger vers $url (oc_platform_home); Besoin d'ajouter ce: use Symfony\Component\HttpFoundation\Response;

        # Redirection methode 2 (courte):
#       return $this->redirect($url);                                                           // permet de rediriger vers $url (oc_platform_home); Besoin d'ajouter ce: use Symfony\Component\HttpFoundation\Response;

        # Redirection methode 3 (sans $url mais avec le nom de la route):
#       return $this->redirectToRoute('oc_platform_CroCombo');                                  // permet de rediriger sans $url (oc_platform_CroCombo); Besoin d'ajouter ce: use Symfony\Component\HttpFoundation\RedirectResponse;


        ########################## CHANGER Content-type http
        # Methode 1 (longue):
#        $response->headers->set('Content-Type', 'application/json');                            // Ici, nous définissons le Content-type pour dire au navigateur que l'on renvoie du JSON et non du HTML
#        return $response;

        # Methode 2 (courte):
#        return new JsonResponse(array('id' => $id));                                            // Besoin d'ajouter ce: use Symfony\Component\HttpFoundation\JsonResponse;

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array('id' => $id));
    }







     # Action add (FlashBag)
    public function addAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'Annonce bien enregistrée');                       // Bien sûr, cette méthode devra réellement ajouter l'annonce. Mais faisons comme si c'était le cas
        $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');           // Le « flashBag » est ce qui contient les messages flash dans la session Il peut bien sûr contenir plusieurs messages :
        $session->getFlashBag()->add('info', 'je confirme  !');           // Le « flashBag » est ce qui contient les messages flash dans la session Il peut bien sûr contenir plusieurs messages :

        return $this->redirectToRoute('oc_platform_view', array('id' => 500));                    // Puis on redirige vers la page de visualisation de cette annonce
    }






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

































