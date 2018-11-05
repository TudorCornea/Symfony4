<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/29/2018
 * Time: 11:32 AM
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="admin_article_new")
     *@IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);

        $form->handleRequest($request); //by default handleRequest only processes the data only at post request
                                        //daca e post , handlerul va lua datele de la submit automat
                                        // iar jos la isSubmitted va returna true
        if($form->isSubmitted() && $form->isValid()){
            /**@var Article $article */
            $article = $form->getData();
            /*$article = new Article();
            $article->setTitle($data['title']);
            $article->setContent($data['content']);
            $article->setAuthor($this->getUser());

            ce e aici facut manual este facut automat in configureOptions in ArticleFormType
            */
            $article->setAuthor($this->getUser());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Created! Knowledge is power!');
            //so flash e o metoda in symfony , aceste messaje se afla pe sesiune si cand se citest o singura data , dispar
            return $this->redirectToRoute('admin_article_list');
        }
        return $this->render('article_admin/new.html.twig',[
            'articleForm' => $form->createView(), //createView transform the object into other object care e super bun la render
                                       //deci noi transformam obiectul form in alt obiect de tipul createView care e bun la render.

        ]);
    }

    /**
     * @Route("/admin/article/{id}/edit")
     * @IsGranted("MANAGE", subject="article")
     */
    public function edit(Article $article)
    {

        dd($article);
    }

    /**
     * @Route("/admin/article", name="admin_article_list")
     */
    public function list(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->render('article_admin/list.html.twig',[
            'articles' => $articles
        ]);
    }
}