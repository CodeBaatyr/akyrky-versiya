<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 27.03.2018
 * Time: 21:08
 */

namespace MainBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Json;



class testController  extends Controller

{

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {




        return $this->render('MainBundle:Test:test.html.twig');


    }



}