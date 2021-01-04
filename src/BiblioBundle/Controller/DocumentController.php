<?php


namespace BiblioBundle\Controller;


use BiblioBundle\Entity\Document;
use BiblioBundle\Form\DocumentForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Datetime;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentController extends Controller
{
    //Consulter les Documents
    public function listAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $documents = $em->getRepository('BiblioBundle:Document')->findAll();
        return $this->render('@Biblio/Document/list.html.twig',array(
            'documents'=>$documents
        ));
    }

    //Consulter les Documents par type
    public function listParTypeAction($type)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $documents = $em->getRepository('BiblioBundle:Document')->findBy(array('type'=>$type));
        return $this->render('@Biblio/Document/listType.html.twig',array(
            'documents'=>$documents
        ));
    }

    //Consulter les Documents par date
    public function listParDateAction($date)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $documents = $em->getRepository('BiblioBundle:Document')->findBy(array('date'=>new DateTime($date)));
        return $this->render('@Biblio/Document/listDate.html.twig',array(
            'documents'=>$documents
        ));
    }

    //Consulter les Documents par auteur
    public function listParAuteurAction($auteur)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $documents = $em->getRepository('BiblioBundle:Document')->findBy(array('auteur'=>$auteur));
        return $this->render('@Biblio/Document/listAuteur.html.twig',array(
            'documents'=>$documents
        ));
    }


    //Ajouter un document
    public function addAction(Request $request)
    {
        $Document = new Document();
        $form = $this->createForm(DocumentForm::class, $Document);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

                $em = $this->getDoctrine()->getManager();
                $em->persist($Document);
                $em->flush();
                return $this->redirect($this->generateUrl("biblio_affichage_document"));

        }

        return $this->render('@Biblio/Document/add.html.twig',array(
            'Form' => $form->createView()
        ));

    }

    //recherche d'un Document Par Nom
    public function rechercheParNomAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $documents = $em->getRepository('BiblioBundle:Document')->findAll();

        if ($request->getMethod("POST"))
        {
            $motcle = $request->get('input_recherche');
            $query = $em->createQuery(
                "SELECT d FROM BiblioBundle:Document d WHERE d.nom LIKE '" . $motcle . "%'"
            );
            $documents = $query->getResult();
        }

        return $this->render('@Biblio/Document/rechercheParNom.html.twig',array(
            'documents'=>$documents
        ));
    }

    //recherche d'un Document Par Type
    public function rechercheParTypeAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $documents = $em->getRepository('BiblioBundle:Document')->findAll();

        if ($request->getMethod("POST"))
        {
            $motcle = $request->get('input_recherche');
            $query = $em->createQuery(
                "SELECT d FROM BiblioBundle:Document d WHERE d.type LIKE '" . $motcle . "%'"
            );
            $documents = $query->getResult();
        }

        return $this->render('@Biblio/Document/rechercheParType.html.twig',array(
            'documents'=>$documents
        ));
    }

    //recherche d'un Document Par date
    public function rechercheParDateAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $documents = $em->getRepository('BiblioBundle:Document')->findAll();

        if ($request->getMethod("POST"))
        {
            $motcle = $request->get('input_recherche');
            $query = $em->createQuery(
                "SELECT d FROM BiblioBundle:Document d WHERE d.date LIKE '" . $motcle . "%'"
            );
            $documents = $query->getResult();
        }

        return $this->render('@Biblio/Document/rechercheParDate.html.twig',array(
            'documents'=>$documents
        ));
    }

    //recherche d'un Document Par Auteur
    public function rechercheParAuteurAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $documents = $em->getRepository('BiblioBundle:Document')->findAll();

        if ($request->getMethod("POST"))
        {
            $motcle = $request->get('input_recherche');
            $query = $em->createQuery(
                "SELECT d FROM BiblioBundle:Document d WHERE d.auteur LIKE '" . $motcle . "%'"
            );
            $documents = $query->getResult();
        }

        return $this->render('@Biblio/Document/rechercheParAuteur.html.twig',array(
            'documents'=>$documents
        ));
    }

    //mise à jour d'un  document
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository('BiblioBundle:Document')->find($id);

        $editform = $this->createForm(DocumentForm::class, $document);
        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid())
        {
            $em->persist($document);
            $em->flush();
            return $this->redirect($this->generateUrl("biblio_affichage_document"));
        }

        return $this->render('@Biblio/Document/update.html.twig',array(
            'editForm' => $editform->createView()
        ));
    }

    //Supprimer un Document
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository('BiblioBundle:Document')->find($id);
        if ($document != null) {
            $em->remove($document);
            $em->flush();
        } else {
            throw new NotFoundHttpException("Le document d'id" . $id . "n'existe pas");
        }

        return $this->redirectToRoute("biblio_affichage_document");
    }

}