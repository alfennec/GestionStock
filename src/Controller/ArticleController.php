<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleController extends AbstractController
{

    /**
     * @var ArticleRepository
     */
    private $rep;

    /**
     * @var CategorieRepository
     */
    private $repCat;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * ArticleController constructor.
     * @param ObjectManager $em
     */


    public function __construct( ArticleRepository $rep, ObjectManager $em, CategorieRepository $repCat)
    {
        $this->rep = $rep;
        $this->em = $em;
        $this->repCat = $repCat;
    }


    /**
     * @Route("/article", name="article", methods="GET|POST")
     */
    public function index()
    {
        $article = $this->rep->findAll();
        $categorie = $this->repCat->findAll();


        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'listArticle' => $article,
            'listCategorie' => $categorie
        ]);
    }


    /**
     * @Route("/EditeArticle/{id}", name="edit.article")
     * @param Article $article
     * @param Request $req
     */
    public function edit(Article $article , Request $req)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToRoute('article');
        }

        return $this->render('article/edite.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/NewArticle", name="new.article")
     * @param Article $article
     * @param Request $req
     */
    public function new(Request $req)
    {
        $article = new Article();

        $categorie = $this->repCat->findAll();
        $choices = [];
        foreach ($categorie as $p)
        {
            $choices[$p->getLibCat()] = $p->getId();
        }

        $form = $this->createForm(ArticleType::class, $article, array('abbrChoices' => $choices));

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($article);
            $this->em->flush();
            return $this->redirectToRoute('article');
        }

        return $this->render('article/new.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{id}", name="delete.article", methods="DELETE")
     * @param Article $article
     */
    public function delete(Article $article)
    {
        dump("supression");
        $this->em->remove($article);
        $this->em->flush();
        return $this->redirectToRoute('article.index');
    }

}
