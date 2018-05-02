<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 23.03.2018
 * Time: 16:13
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


class ajaxController extends Controller
{




    /**
     * @Route("/foo", options={"expose"=true}, name="my_route_to_expose")
     */
    public function checkLogAction(Request $request)
    {
      $category = $this->getDoctrine()->getRepository('MainBundle:Category') ->findAll();
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach($category as $categorys) {
                $temp = array(
                    'name' => $categorys->getName(),

                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return new Response(
                'ajax request fail  !!!!!: '
            );
        }
      //  return $this->render('MainBundle:Main:ajax.html.twig',array('data'=> $category));

    }
    /**
 * @Route("/form", options={"expose"=true}, name="form")
 */
    public function checkAction(Request $request)
    {
//        $category = $this->getDoctrine()->getRepository('MainBundle:Category') ->findAll();
        return $this->render('MainBundle:Main:ajax.html.twig',array('data'=> 'true'));

    }
    /**
     * @Route("/reg", options={"expose"=true}, name="reg")
     */
    public function regAction(Request $request)
    {
//        $category = $this->getDoctrine()->getRepository('MainBundle:Category') ->findAll();
        return $this->render('MainBundle:Main:ajax.html.twig',array('data'=> 'true'));

    }


}