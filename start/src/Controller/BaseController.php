<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 11/2/2018
 * Time: 11:42 AM
 */

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected function getUser(): User
    {
        return parent::getUser();
    }
}