<?php


namespace BiblioBundle\Controller;


use BiblioBundle\Form\EditUserRoleForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{

    //page index de l'admin
    public function indexAction()
    {
        return $this->render('@Biblio/Admin/index.html.twig');
    }

    //liste d'utilisateurs
    public function listUsersAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Users = $em->getRepository('BiblioBundle:User')->findAll();
        return $this->render('@Biblio/Admin/listUsers.html.twig',array(
            'users'=>$Users
        ));
    }


    //List des Documents
    public function listDocumentAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $documents = $em->getRepository('BiblioBundle:Document')->findAll();
        return $this->render('@Biblio/Admin/listDocument.html.twig',array(
            'documents'=>$documents
        ));
    }

    //mise à jour d'un  user
    public function updateUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BiblioBundle:user')->find($id);

        $editform = $this->createForm(EditUserRoleForm::class, $user);

        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid())
        {
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_listUsers"));
        }

        return $this->render('@Biblio/Admin/updateUser.html.twig',array(
            'editForm' => $editform->createView()
        ));
    }


    //Supprimer un Utilisateur
    public function deleteUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BiblioBundle:User')->find($id);
        if ($user != null) {
            $em->remove($user);
            $em->flush();
        } else {
            throw new NotFoundHttpException("L'utilisateur avec l'id" . $id . "n'existe pas");
        }

        return $this->redirectToRoute("admin_listUsers");
    }
}