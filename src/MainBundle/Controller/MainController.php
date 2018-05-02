<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/{_locale}")
 */
class MainController extends Controller
{


    /**
     * @Route("", name="main_index")
     * @Template()
     */

    public function indexAction()
    {

        return $this->render('MainBundle:Main:index.html.twig');
    }

//    /**
//    * @Route("/form", name="forma")
//    *
//    */
//
//    public function formAction()
//    {
//        return $this->render('MainBundle:Main:form.html.twig');
//    }
}