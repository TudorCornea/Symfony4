<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/24/2018
 * Time: 11:03 AM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
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
        return new Response(sprintf('Future page show one:%s'
        ,$slug
        ));
    }
}