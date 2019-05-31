<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class PersonnelController extends AbstractController
{
    /**
     * @var PersonnelRepository
     */
    private $rep;

     /**
     * @var DepartementRepository
     */
    private $repDep;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * PersonnelController constructor.
     * @param ObjectManager $em
     */


    public function __construct( PersonnelRepository $rep, ObjectManager $em, DepartementRepository $repDep)
    {
        $this->rep = $rep;
        $this->em = $em;
        $this->repDep = $repDep;
    }


    /**
     * @Route("/personnel", name="personnel", methods="GET|POST")
     */
    public function index()
    {
        $personnel = $this->rep->findAll();
        $departement = $this->repDep->findAll();
        
        return $this->render('personnel/index.html.twig', [
            'controller_name' => 'personnelController',
            'listpersonnel' => $personnel,
            'listdepartement' => $departement,
        ]);
    }


    /**
     * @Route("/EditePersonnel/{id}", name="edit.personnel")
     * @param Personnel $personnel
     * @param Request $req
     */
    public function edit(Personnel $personnel , Request $req)
    {
        $departement = $this->repDep->findAll();

        $choices = [];

        foreach ($departement as $p)
        {
            $choices[$p->getLibDept()] = $p->getId();
        }

        $form = $this->createForm(PersonnelType::class, $personnel, array('abbrChoices' => $choices));

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToRoute('personnel');
        }

        return $this->render('personnel/edite.html.twig', [
            'controller_name' => 'personnelController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/NewPersonnel", name="new.personnel")
     * @param Personnel $personnel
     * @param Departement $departement
     * @param Request $req
     */
    public function new(Request $req)
    {
        $personnel = new personnel();

        $departement = $this->repDep->findAll();

        $choices = [];

        foreach ($departement as $p)
        {
            $choices[$p->getLibDept()] = $p->getId();
        }

        $form = $this->createForm(PersonnelType::class, $personnel, array('abbrChoices' => $choices));

        //$form = $this->createForm(PersonnelType::class, $personnel);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($personnel);
            $this->em->flush();
            return $this->redirectToRoute('personnel');
        }

        return $this->render('personnel/new.html.twig', [
            'controller_name' => 'personnelController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/personnel/{id}", name="delete.personnel", methods="DELETE")
     * @param Personnel $personnel
     */
    public function delete(Personnel $personnel)
    {
        dump("supression");
        $this->em->remove($personnel);
        $this->em->flush();
        return $this->redirectToRoute('personnel');
    }

}