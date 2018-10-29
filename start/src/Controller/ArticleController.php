<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticleController extends AbstractController
{

    private $isDebug;

    public function __construct(bool $isDebug)
    {

        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest(); //daca nu pui nimic la primul array , o sa-ti dea tot

        return $this->render('article/homepage.html.twig',[
          'articles' => $articles
        ]);
    }

    /**
     *
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(Article $article,SlackClient $slack)
    {

        if ($article->getSlug() == 'KHANNANANNANANANANAN') {
             $slack->sendMessage('Khan','Ah , my old friend');
        }
        // this is a trick  , daca ai numele de la route slug acelasi ca in tabel poti sa folosesti trickul acesta .
        // daca pui la parametru un entity class , symfony automatically will query for that entity , deci daca
        //ai slug la route la PLACEHOLDER VALUES si la tabel stie el cum sa le lege
        // deci my wildcard trebuie numit la fel ca proprietatea tabelului

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];


        return $this->render('article/show.html.twig', [
            'article' =>$article,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartcount();
        $em->flush(); // nu e nevoie de persist la updaturi , deoarece el deja stie
        // TODO - actually heart/unheart the article!

        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}
