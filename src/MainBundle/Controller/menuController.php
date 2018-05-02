<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 27.03.2018
 * Time: 19:41
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



class menuController extends Controller
{
    /**
     * @Route("/profile", options={"expose"=true}, name="profile")
     */
    public function profileAction(Request $request)
    {
        if (isset($_SESSION['login_email'])){

            $login = $_SESSION['login_email'];
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
            $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));
            $array=$user->getProfile();
            if (!empty($array)) {
                $keys = array_keys($array);//ключтардын массиви
//         var_dump('first key:'.$keys[0].'<br> last key'.$keys[count($keys)-1].'<br> count of keys :'.count($keys));
                $i = 0;
                $var=true;
                $category=array();
                while ($i < count($array) &&  $var) {
                    if (isset($array[$keys[$i]]['test'])) {
                        $category[$i]["position"] = $category_position_style[$array[$keys[$i]]['position']]['style'];
                        $category[$i]["name"] = $array[$keys[$i]]['name'];
                        $category[$i]["styleWidth"] = " width:" . $array[$keys[$i]]['jalpy'] . "%;";
                        $category[$i]["baa"] = $array[$keys[$i]]['jalpy'];
                        $category[$i]["dayarBy"] = $array[$keys[$i]]['dayarBy'];
                        $i++;
                    }else $var=false;
                }


                if (count($category) > 0) {
                    return $this->render('MainBundle:Profile:profile.html.twig', array('login' => $login,
                        'array' => $category,
                        'isNotIndexPage'=>true,
                        'profile'=>true));

                } else {
                    return $this->render('MainBundle:Profile:error.html.twig');
                }

            }else{
                return $this->render('MainBundle:Profile:error.html.twig');
            }

        }else{
            return new Response(
                '<html><body> page not found error 404   </body></html>'
            );
        }


    }
    /**
     * @Route("/check_profile", options={"expose"=true}, name="check_profile")
     */
    public function check_profileAction(Request $request)
    {



            $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));
            $array=$user->getProfile();
            if (!empty($array)) {


                $category = $this->getDoctrine()->getRepository('MainBundle:Category')->findAll();

                if (isset($array[$category[0]->getId()]['test'])){
                    return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>true));
                }else{


                    return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>false));

                }



            }else{
                return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>false));
            }




    }

    /**
     * @Route("/exit_profile", options={"expose"=true}, name="exit_profile")
     */
    public function exit_profileAction(Request $request)
    {
        unset($_SESSION['auth']);
        unset($_SESSION['login_email']);
        unset($_SESSION['password']);
        unset($_SESSION['id']);

        return $this->render('MainBundle:Main:index.html.twig');


    }

    /**
     * @Route("/category", name="category")
     */
    public function categoryAction(Request $request)
    {
        unset($_SESSION['auth']);
        unset($_SESSION['login_email']);
        unset($_SESSION['password']);

        return $this->render('MainBundle:Category:category.html.twig');


    }

    /**
     * @Route("/category_menu", name="category_menu")
     */
    public function category_menuAction(Request $request)
    {


        return $this->render('MainBundle:Category:category.html.twig');


    }
    /**
     * @Route("/bolum/{cat_id}", options={"expose"=true}, name="bolum")
     */
    public function bolumAction($cat_id)
    {
        if(isset($_SESSION['id'])) {
            $user = $this->getDoctrine()->getRepository('MainBundle:User')->findOneBy(array('id' => $_SESSION['id']));

            $active = $user->getBolum();


            return $this->render('MainBundle:Bolum:bolum.html.twig', array('cat_id' => $cat_id, 'active' => $active[(int)$cat_id]
            ,'isNotIndexPage'=>true));
        }else{
            return new Response(
                '<html><body> page not found error 404   </body></html>'
            );
        }

    }
}