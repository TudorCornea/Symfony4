<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/24/2018
 * Time: 11:03 AM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// de ce faci extindere la Abstract , deobicei nu e nevoie o faci pt shortcut methods
class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Omg my first page');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        $comments = [
            'I ate a normal rock once. It did not taste like bacon!',
            'I like bacon too! Buy some from my site!',
        ];


        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', '', $slug)),
            'comments' =>$comments,
        ]);
    }
}