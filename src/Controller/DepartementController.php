<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class DepartementController extends AbstractController
{
    /**
     * @var DepartementRepository
     */
    private $rep;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * PersonnelController constructor.
     * @param ObjectManager $em
     */


    public function __construct( DepartementRepository $rep, ObjectManager $em)
    {
        $this->rep = $rep;
        $this->em = $em;
    }

    /**
     * @Route("/departement", name="departement" , methods="GET|POST")
     */
    public function index()
    {
        $departement = $this->rep->findAll();

        return $this->render('departement/index.html.twig', 
        [
            'controller_name' => 'DepartementController',
            'listdepartement' => $departement,
        ]);
    }

    /**
     * @Route("/EditeDepartement/{id}", name="edit.departement")
     * @param Departement $departement
     * @param Request $req
     */
    public function edit(Departement $departement , Request $req)
    {
        $form = $this->createForm(DepartementType::class, $departement);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToRoute('departement');
        }

        return $this->render('departement/edite.html.twig', [
            'controller_name' => 'personnelController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/NewDepartement", name="new.departement")
     * @param Personnel $departement
     * @param Request $req
     */
    public function new(Request $req)
    {
        $departement = new departement();

        /*$categorie = $this->repCat->findAll();
        $choices = [];
        foreach ($categorie as $p)
        {
            $choices[$p->getLibCat()] = $p->getId();
        }*/

        //$form = $this->createForm(ArticleType::class, $article, array('abbrChoices' => $choices));

        $form = $this->createForm(DepartementType::class, $departement);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($departement);
            $this->em->flush();
            return $this->redirectToRoute('departement');
        }

        return $this->render('departement/new.html.twig', [
            'controller_name' => 'personnelController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/departement/{id}", name="delete.departement", methods="DELETE")
     * @param Departement $departement
     */
    public function delete(Departement $departement)
    {
        dump("supression");
        $this->em->remove($departement);
        $this->em->flush();
        return $this->redirectToRoute('departement');
    }
}
