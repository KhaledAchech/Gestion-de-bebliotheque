<?php


namespace BiblioBundle\Controller;


use BiblioBundle\Entity\Emprunter;
use BiblioBundle\Entity\User;
use BiblioBundle\Form\DocumentForm;
use BiblioBundle\Form\ModifyEmpruntForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \DateInterval;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Security;



class EmpruntController extends Controller
{

    //Emprunter un Document
    public function empruntDocumentAction($id){
        $emprunter = new Emprunter();

        $em = $this->getDoctrine()->getManager();
        $documentEmprunte = $em->getRepository('BiblioBundle:Document')->find($id);
        $document = $em->getRepository('BiblioBundle:Emprunter')->findBy(['Document_emprunte' => $documentEmprunte]);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($document != null)
        {
            return $this->render('@Biblio/Emprunter/DocumentEmprunte.html.twig');
        }
        else
        {
        $emprunter->setDateEmp(new \DateTime('now'));
        $now = new \DateTime('now');
        $emprunter->setDateRetour($now->add(new DateInterval('P30D')));
        $emprunter->setEmprunteur($user);
        $emprunter->setDocumentEmprunte($documentEmprunte);
        $em->persist($emprunter);
        $em->flush();
            return $this->render('@Biblio/Emprunter/Succes.html.twig');
        }
        //return $this->redirect($this->generateUrl("biblio_affichage_document"));

    }

    //Consulter les emprunts
    public function listEmpruntsAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $emprunts = $em->getRepository('BiblioBundle:Emprunter')->findAll();
        return $this->render('@Biblio/Emprunter/list.html.twig',array(
            'emprunts'=>$emprunts
        ));
    }

    //lister les emprunts d'un utilisateur
    public function listEmpruntsbyUserAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->container->get('doctrine')->getEntityManager();
        $emprunts = $em->getRepository('BiblioBundle:Emprunter')->findBy(['emprunteur' => $user]);
        return $this->render('@Biblio/Emprunter/listByUser.html.twig',array(
            'emprunts'=>$emprunts
        ));
    }

    //modifier les emprunts
    public function updateEmpruntAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $emprunt = $em->getRepository('BiblioBundle:Emprunter')->find($id);

        $editform = $this->createForm(ModifyEmpruntForm::class, $emprunt);
        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid())
        {
            $em->persist($emprunt);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_listEmprunts"));
        }

        return $this->render('@Biblio/Emprunter/update.html.twig',array(
            'editForm' => $editform->createView()
        ));
    }

    //supprimer une emprunt
    public function deleteEmpruntAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $emprunt = $em->getRepository('BiblioBundle:Emprunter')->find($id);
        if ($emprunt != null) {
            $em->remove($emprunt);
            $em->flush();
        } else {
            throw new NotFoundHttpException("L'emprunt d'id" . $id . "n'existe pas");
        }

        return $this->redirectToRoute("admin_listEmprunts");
    }
    //Annuler une emprunt
    public function anuulerEmpruntAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $emprunt = $em->getRepository('BiblioBundle:Emprunter')->find($id);
        if ($emprunt != null) {
            $em->remove($emprunt);
            $em->flush();
        } else {
            throw new NotFoundHttpException("L'emprunt d'id" . $id . "n'existe pas");
        }

        return $this->redirectToRoute("user_listEmprunts");
    }


}