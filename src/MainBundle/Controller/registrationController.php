<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 27.03.2018
 * Time: 17:05
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


class registrationController extends Controller

{

    /**
     * @Route("/check_login", options={"expose"=true}, name="check_login")
     */
    public function check_loginAction(Request $request)
    {
        $login=$request->request->get('reg_login_les');
        $user = $this->getDoctrine()->getRepository('MainBundle:User')
            ->createQueryBuilder('user')
            ->where('user.login =:login')
            ->setParameter('login',$login)
            ->getQuery()
            ->getResult();

        if(empty($user) )
            return $this->render('MainBundle:Assistant:checker.html.twig',array('checker'=> 'true'));
        else
            return $this->render('MainBundle:Assistant:checker.html.twig',array('checker'=> 'false'));

    }
    /**
     * @Route("/check_email", options={"expose"=true}, name="check_email")
     */
    public function check_emailAction(Request $request)
    {
        $email=$request->request->get('reg_email_les');
        $user = $this->getDoctrine()->getRepository('MainBundle:User')
            ->createQueryBuilder('user')
            ->where('user.email=:email')
            ->setParameter('email',$email)
            ->getQuery()
            ->getResult();


        if(empty($user) )
            return $this->render('MainBundle:Assistant:checker.html.twig',array('checker'=> 'true'));
        else
            return $this->render('MainBundle:Assistant:checker.html.twig',array('checker'=> 'false'));

    }


    /**
     * @Route("/reg", options={"expose"=true}, name="reg")
     */

    public function registrationAction(Request $request)
    {



        $login =$_POST["login"];
        $pasword =$_POST["password"];
        $vhodPasword=$pasword;
        $pasword   = md5($pasword);
        $email = $_POST["email"];
        $var=true;
        $id=1;
        while ($var) {
            $category = $this->getDoctrine()->getRepository('MainBundle:Category')->
            findOneBy(array('id' => $id));


            if (!empty($category)) {
                $var = false;
            } else {

                $id++;


            }

        }

        $bolum=array($category->getId()=>1);
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($pasword);
        $user->setEMail($email);
        $user->setCount( $category->getId());
        $user->setBolum($bolum);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
                $temp = array(
                    'pasword' => $vhodPasword,
                    'login' => $login
                );
                $jsonData[0] = $temp;


            return new JsonResponse($jsonData);
        } else {
            return new Response(
                'ajax request is failed  backend !!!!!: '
            );
        }

    }

}