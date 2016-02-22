<?php
  namespace POL\CarnetBundle\Controller;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use POL\CarnetBundle\Entity\ListeContact;
  use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

  class ListeContactController extends Controller{

    public function indexAction(){

      //Ici, on récupérera la liste des contacts avec toutes les informations
        if($this->getUser()){
          $id = $this->getUser()->getId();
          $repository = $this->getDoctrine()->getManager()->getRepository('POLCarnetBundle:ListeContact');
          $contact = $repository->getAllContact($id);

          return $this->render('POLCarnetBundle:ListeContact:index.html.twig', array(
          'listContacts'=>$contact
          ));
        }
        else{
          return $this->render('POLCarnetBundle:ListeContact:index.html.twig',  array(
          'listContacts'=>''
          ));
        }
    }

    public function addAction(Request $request){
      if( $this->getUser() ){
        //Création de l'entité
        $contact = new ListeContact();

        //Création du formulaire
        $formBuilder = $this->get('form.factory')->createBuilder('form', $contact);

        $formBuilder
          ->add('contactId', 'text', array('label'=>"Pseudonyme du contact :"))
          ->add('Envoyer', 'submit');

        $form = $formBuilder->getForm();

        //Lien entre la requête et le formulaire
        $form->handleRequest($request);
        //Utilisatur courant
        if($form->isValid()){
          $contact->setUsernameId($this->getUser());
          //Utilisateur qu'il souhaite ajouter
          $ajoutContact = $request->request->get('form')['contactId'];
          $contactExist = $this->get('fos_user.user_manager')->findUserBy(array('username'=>$ajoutContact));

          //Check si le contact est déjà ajouté
          $idUser = $this->getUser()->getId();
          $id = $contactExist->getId();
          $repository = $this->getDoctrine()->getManager()->getRepository('POLCarnetBundle:ListeContact');
          $checkIsset = $repository->checkIssetContact($id,$idUser);

          if($contactExist == NULL){

            $request->getSession()->getFlashBag()->add('notice','Le contact n\'existe pas.');
            return $this->render('POLCarnetBundle:ListeContact:add.html.twig', array('form'=> $form->createView()));
          }
          else if($contactExist == (string) $this->getUser()->getUsername() ){

            $request->getSession()->getFlashBag()->add('notice','Impossible');
            return $this->render('POLCarnetBundle:ListeContact:add.html.twig', array('form'=> $form->createView()));
          }
          else if($checkIsset != NULL){
            $request->getSession()->getFlashBag()->add('notice','Vous avez déjà ajouter le contact.');
            return $this->render('POLCarnetBundle:ListeContact:add.html.twig', array('form'=> $form->createView()));
          }
          else{
            $contact->setContactId($contactExist);

            //Récupération de l'Entity manager
            $em = $this->getDoctrine()->getManager();

            //Persiste l'entité
            $em->persist($contact);

            // On flush tout ce qui a été persisté
            $em->flush();

            //Si la requête est en POST càd que l'utilisateur souhaite ajouter un contact
            if($request->isMethod('POST')){

              //Création et gestion du formulaire
              $request->getSession()->getFlashBag()->add('noticeContact','Contact bien enregistré.');
              //On redirige vers la page d'accueil
              return $this->redirectToRoute('pol_carnet_home');
            }
          }
        }
        //Si on est pas en POST on affiche le formulaire
        return $this->render('POLCarnetBundle:ListeContact:add.html.twig', array('form'=> $form->createView()));
      }
      else{
        return $this->render('POLCarnetBundle:ListeContact:index.html.twig',  array(
        'listContacts'=>''
        ));
      }
    }

    public function deleteAction($id){
      if( $this->getUser() ){
        //Ici, on récupérera l'id du contact à supprimer

        //Ici on générera la suppression du contact
        $repository = $this->getDoctrine()->getManager()->getRepository('POLCarnetBundle:ListeContact');
        $contactDelete = $repository->find($id);
        //Récupération de l'Entity manager
        $em = $this->getDoctrine()->getManager();

        //Persiste l'entité
        $em->remove($contactDelete);

        // On flush tout ce qui a été persisté
        $em->flush();

        return $this->render('POLCarnetBundle:ListeContact:delete.html.twig');
      }
      else {
        return $this->render('POLCarnetBundle:ListeContact:index.html.twig',  array(
        'listContacts'=>''
        ));
      }
    }

    public function viewAction($id){
          $idUser =  $this->getUser()->getId();
          $repository = $this->getDoctrine()->getManager()->getRepository('POLCarnetBundle:ListeContact');
          $contact = $repository->getContactWithData($id,$idUser);
          if(empty($contact)) {
            throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
          }
          return $this->render('POLCarnetBundle:ListeContact:details.html.twig', array('contact'=>$contact));
        }

}





 ?>
