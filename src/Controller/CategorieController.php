<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class CategorieController extends AbstractController
{
    /**
     * @var CategorieRepository
     */
    private $rep;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * ArticleController constructor.
     * @param ObjectManager $em
     */


    public function __construct( CategorieRepository $rep, ObjectManager $em)
    {
        $this->rep = $rep;
        $this->em = $em;
    }


    /**
     * @Route("/categorie", name="categorie")
     */
    public function index()
    {
        $categorie = $this->rep->findAll();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'listeCategorie' => $categorie
        ]);
    }

    /**
     * @Route("/EditeCategorie/{id}", name="edit.categorie")
     * @param Categorie $categorie
     * @param Request $req
     */
    public function edit(Categorie $categorie , Request $req)
    {
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToRoute('categorie');
        }

        return $this->render('categorie/edite.html.twig', [
            'controller_name' => 'CategorieController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/NewCategorie", name="new.categorie")
     * @param Categorie $categorie
     * @param Request $req
     */
    public function new(Request $req)
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($categorie);
            $this->em->flush();
            return $this->redirectToRoute('categorie');
        }

        return $this->render('categorie/new.html.twig', [
            'controller_name' => 'CategorieController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="delete.categorie", methods="DELETE")
     * @param Categorie $categorie
     */
    public function delete(Categorie $categorie)
    {
        dump("supression");
        $this->em->remove($categorie);
        $this->em->flush();
        return $this->redirectToRoute('categorie');
    }
}
