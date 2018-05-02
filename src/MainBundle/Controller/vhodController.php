<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 27.03.2018
 * Time: 17:23
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


class vhodController extends Controller

{



    /**
     * @Route("/vhod", options={"expose"=true}, name="vhod")
     */

    public function vhodAction(Request $request)
    {
        $login_email =$_POST["login_email"];
        $password=$_POST["password"];
        $password   = md5($password);
         $user = $this->getDoctrine()->getRepository('MainBundle:User')
            ->createQueryBuilder('user')
            ->andWhere('user.email=:login_email OR user.login=:login_email')
            ->andWhere('user.password=:password')
            ->setParameter('login_email',$login_email)
            ->setParameter('password',$password)
            ->getQuery()
            ->getResult();
        if(!empty($user) ) {
            if(!isset($_SESSION)) {
                session_start();

            }
            $_SESSION['auth'] = 'yes_auth';
            $_SESSION['login_email'] = $login_email;
            $_SESSION['password'] = $password;
            $_SESSION['id']=$user[0]->getId();
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => 1));
        }
        else
            return $this->render('MainBundle:Assistant:checker.html.twig',array('checker'=>0));


    }
    /**
     * @Route("/category", options={"expose"=true}, name="category")
     */

    public function categoryAction()
    {       if (isset($_SESSION["id"])){


        $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));

        $categoryActive = $this->getDoctrine()->getRepository('MainBundle:Category')
            ->createQueryBuilder('category')
            ->where('category.id <=:count')
            ->setParameter('count',$user->getCount())
            ->getQuery()
            ->getResult();
        $categoryPassive = $this->getDoctrine()->getRepository('MainBundle:Category')
            ->createQueryBuilder('category')
            ->where('category.id >:count')
            ->setParameter('count',$user->getCount())
            ->getQuery()
            ->getResult();
        if (!empty($user) && !empty($categoryActive) ) {


            //start

           $iActive=0;
            $iPasive=0;
            $countOfCategory=count($categoryPassive)+count($categoryActive);
            $category_position_style=array(
                 1=>array('style'=>"background-position: 0px 0;"),
                 2=>array('style'=>"background-position: -110px 0;"),
                 3=>array('style'=>"background-position: -220px 0;"),
                 4=>array('style'=>"background-position: -330px 0;"),
                 5=>array('style'=>"background-position: -440px 0;"),
                 6=>array('style'=>"background-position: -550px 0;"),
                 7=>array('style'=>"background-position: -660px 0;"),
                 8=>array('style'=>"background-position: -770px 0;"),
                 9=>array('style'=>"background-position: -880px 0;"),
                 10=>array('style'=>"background-position: -990px 0;"),

                11=>array('style'=>"background-position: 0px -110px;"),
                12=>array('style'=>"background-position: -110px -110px;"),
                13=>array('style'=>"background-position: -220px -110px;"),
                14=>array('style'=>"background-position: -330px -110px;"),
                15=>array('style'=>"background-position: -440px -110px;"),
                16=>array('style'=>"background-position: -550px -110px;"),
                17=>array('style'=>"background-position: -660px -110px;"),
                18=>array('style'=>"background-position: -770px -110px;"),
                19=>array('style'=>"background-position: -880px -110px;"),
                20=>array('style'=>"background-position: -990px -110px;"),

                21=>array('style'=>"background-position: 0px -220px;"),
                22=>array('style'=>"background-position: -110px -220px;"),
                23=>array('style'=>"background-position: -220px -220px;"),
                24=>array('style'=>"background-position: -330px -220px;"),
                25=>array('style'=>"background-position: -440px -220px;"),
                26=>array('style'=>"background-position: -550px -220px;"),
                27=>array('style'=>"background-position: -660px -220px;"),
                28=>array('style'=>"background-position: -770px -220px;"),
                29=>array('style'=>"background-position: -880px -220px;"),
                30=>array('style'=>"background-position: -990px -220px;"),

                31=>array('style'=>"background-position: 0px -330px;"),
                32=>array('style'=>"background-position: -110px -330px;"),
                33=>array('style'=>"background-position: -220px -330px;"),
                34=>array('style'=>"background-position: -330px -330px;"),
                35=>array('style'=>"background-position: -440px -330px;"),
                36=>array('style'=>"background-position: -550px -330px;"),
                38=>array('style'=>"background-position: -770px -330px;"),
                39>array('style'=>"background-position: -880px -330px;"),
                40=>array('style'=>"background-position: -990px -330px;")













            );

            for ($i=0;$i<$countOfCategory;$i++){

                 if (count($categoryActive)-1>=$i){
                     $category[$i]["position"]=$category_position_style[$categoryActive[$iActive]->getPosition()]['style'];
                     $category[$i]["name"]=$categoryActive[$iActive]->getName();
                      $category[$i]["isActive"]=true;
                     $category[$i]["id"]=$categoryActive[$iActive]->getId();
                     $iActive++;
                 }else{

                     $category[$i]["position"]=$category_position_style[$categoryPassive[$iPasive]->getPosition()]['style'];
                     $category[$i]["name"]=$categoryPassive[$iPasive]->getName();
                     $category[$i]["isActive"]=false;
                     $category[$i]["id"]=$categoryPassive[$iPasive]->getId();
                     $iPasive++;
                 }


            }

            return $this->render('MainBundle:Category:category.html.twig', array('category' => $category,
                'isNotIndexPage'=>false
            ));
        }
        else
            return new Response(
            '<html><body> user whith '.$_SESSION["id"].' found! </body></html>'
        );
    }

         else{
             return new Response(
                 '<html><body> page not found error 404 </body></html>'
             );

         }



    }

}