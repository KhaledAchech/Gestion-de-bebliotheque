<?php


namespace BiblioBundle\Controller;


use BiblioBundle\Entity\Document;
use BiblioBundle\Entity\Emprunter;
use BiblioBundle\Form\DocumentForm;
use BiblioBundle\Form\ModifyUserAccountForm;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    //modifier son compte
    public function ModifyAccountAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $passwordEncoder = $this->get('security.password_encoder');

        $editform = $this->createForm(ModifyUserAccountForm::class, $user);
        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid())
        {
            $hash= $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl("biblio_affichage_document"));
        }

        return $this->render('@Biblio/User/modifyAccount.html.twig',array(
            'editForm' => $editform->createView()
        ));

    }

    //envoyer un message
    public function SendMessageAction()
    {
        return $this->render('@Biblio/User/SendMessage.html.twig');
    }

    //Emprunter un Document
    public function empruntDocumentAction(){
            $emprunter = new Emprunter();

            $em = $this->getDoctrine()->getManager();
            /*$document = $em->getRepository('BiblioBundle:Emprunt')->find($id);
            if ($document != null)
            {
                throw Exception::class("Document déja emprunter");
            }
            else
            {
            $emprunter->setDateEmp(date());
            $emprunter->setDateRetour($emprunter->getDateEmp()->add(new DateInterval('P30D')));
            $em->persist($emprunter);
            $em->flush();
            }
            return $this->redirect($this->generateUrl("biblio_emprunter_document"));
        */
        }


}