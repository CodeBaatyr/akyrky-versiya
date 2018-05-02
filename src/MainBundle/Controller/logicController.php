<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 01.04.2018
 * Time: 15:58
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
require '../src/MainBundle/Controller/test.php';


class logicController extends Controller
{



    /**
     * @Route("/start/{cat_id}", options={"expose"=true}, name="start")
     */
    public function startAction($cat_id)
    {

        $category_id=$cat_id;
        //отимизация кылыш керек
        $category = $this->getDoctrine()->getRepository('MainBundle:Category')->find($cat_id);
        $sozdor = $category->getSurotMenenIsh();
        if(empty($sozdor[0])){
            return new Response(
                '<html><body> этот раздел не создан пожайлуста добавьте этот раздел в базу  </body></html>'
            );

        }
         else{
             return $this->redirectToRoute('bolum_foto', array('cat_id' =>$category_id ,
                 'id'=>$sozdor[0]->getId(),'count'=>0,
                 'totalCount'=>count($sozdor),'counter'=>1));

         }



    }
    /**
     * @Route("/next/{count}", options={"expose"=true}, name="next")
     */
    public function nextAction($count)
    {

        $count=(int)$count;
        $surot_menen_ishto_id =$_POST["surot_menen_ishto_id"];
        $category_id=$_POST["category_id"];
        $var=true;
        $surot_menen_ish = $this->getDoctrine()->getRepository('MainBundle:Surot_menen_ish')->findBy(array('category' => $category_id));
        $countOfEnd=count($surot_menen_ish);
        $lastId=$surot_menen_ish[$countOfEnd-1]->getId();
        $finish=0;
        if ($lastId==$surot_menen_ishto_id)
              $finish=1;

         if ($finish==0) {

             $surot_menen_ishto_id++;
             while ($var) {
                 $surot_menen_ish = $this->getDoctrine()->getRepository('MainBundle:Surot_menen_ish')->
                 findOneBy(array('id' => $surot_menen_ishto_id, 'category' => $category_id));


                 if (!empty($surot_menen_ish)) {
                     $var = false;
                 } else {

                     $surot_menen_ishto_id++;


                 }

             }
             return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => $surot_menen_ish->getId()));
         }

        else{
            $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));
            $prozent=($count*100)/$countOfEnd;
            if ($prozent>=90)
                $baa='Превосходно!!!|Вы ответили '.$prozent.'% верно';
            else if($prozent>=70)
                $baa='Вы молодец!!!|Вы ответили '.$prozent.'% верно';
            else if($prozent>=50)
                $baa='Старайтесь еще лучьше!!!|Вы ответили '.$prozent.'% верно';
            else if($prozent>0) $baa='По больше занимайтесь|Вы ответили '.$prozent.'% верно';
            else $baa='Очень жаль!!!|Вы не ответили ни одного правильного ответа';
            $kiyinkibolum='.0';
           if ($prozent>=60) {
             //кийинки болумдуу ачуу башы


               $bolum = $user->getBolum();
               if ( $bolum[(int)$category_id]<2 ){

                   $kiyinkibolum='.1';
                   $bolum[(int)$category_id] = 2;
                   $user->setBolum($bolum);


               }


               //кийинки болумдуу ачуу аягы
               //профил башы
               $category=$this->getDoctrine()->getRepository('MainBundle:Category') ->findOneBy(array('id' =>(int)$category_id));
               $profile=$user->getProfile();
               if (isset($profile[(int)$category_id]['kotor']) && isset($profile[(int)$category_id]['test'])){//ушундай индекси бар болсо жана null эмес болсо
                   $profile[(int)$category_id]['soz']=$prozent*0.2;

                   $profile[(int)$category_id]['jalpy']=$profile[(int)$category_id]['test'] +$profile[(int)$category_id]['kotor'] +$profile[(int)$category_id]['soz'];

               }
               else if(isset($profile[(int)$category_id]['kotor'])){//ушундай индекси бар болсо жана null эмес болсо
                   $profile[(int)$category_id]['soz']=$prozent*0.2;


               }
               else if(isset($profile[(int)$category_id]['soz'])){//ушундай индекси бар болсо жана null эмес болсо
                   $profile[(int)$category_id]['soz']=$prozent*0.2;


               }else {
                   $profile[(int)$category_id]['soz']=$prozent*0.2;
                   $profile[(int)$category_id]['dayarBy']=false;
                   $profile[(int)$category_id]['name']=$category->getName();
                   $profile[(int)$category_id]['position']=$category->getPosition();

             }



                $user->setProfile( $profile);
               //профиль аягы
               //сактоо
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($user);
               $entityManager->flush();

           }

            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>'-1'.$baa.$kiyinkibolum));

        }


    }
    /**
     * @Route("/bolum_foto/{cat_id}/{id}/{count}/{totalCount}/{counter}", options={"expose"=true}, name="bolum_foto")
     */
    public function bolum_fotoAction($cat_id,$id,$count,$totalCount,$counter)
    {
       if (isset($_SESSION['id'])) {
           $cat_id = (int)$cat_id;
           $id = (int)$id;
           $surot_menen_ish = $this->getDoctrine()->getRepository('MainBundle:Surot_menen_ish')->
           findOneBy(array('id' => $id, 'category' => $cat_id));
           if (!empty($surot_menen_ish)) {
               $var = array(0, 1, 2);
               shuffle($var);
               $array = array($var[0] => array("soz" => $surot_menen_ish->getKst(), "surot" => $surot_menen_ish->getKSTimg()

               ),
                   $var[1] => array("soz" => $surot_menen_ish->getKSV1(), "surot" => $surot_menen_ish->getKSV1img()
                   ),
                   $var[2] => array("soz" => $surot_menen_ish->getKSV2(), "surot" => $surot_menen_ish->getKSV2img()
                   )
               );
               return $this->render('MainBundle:Bolum:bolum__foto.html.twig', array('surot_menen_ish' => $surot_menen_ish,
                       'surot_menen_ish_random' => $array,
                       'category_id' => $cat_id,
                       'count' => $count,
                       'totalCount'=>$totalCount,
                       'counter'=>$counter,
                       'isNotIndexPage'=>true
                       ,'bolum'=>$cat_id
                   )
               );
           } else {
               return new Response(
                   '<html><body> предложение с id '.$id.'  в категории с id '.$cat_id.'    не найдено   </body></html>'
               );

           }
       }else{
           return new Response(
               '<html><body> page not found error 404   </body></html>'
           );
       }
       }

        /**
         * @Route("/check_soz/{count}", options={"expose"=true}, name="check_soz")
         */
        public function check_sozAction($count)
    {

        $check_soz =$_POST["select_soz"];
        $surot_menen_ishto_id =$_POST["surot_menen_ishto_id"];
        $surot_menen_ish = $this->getDoctrine()->getRepository('MainBundle:Surot_menen_ish')->find($surot_menen_ishto_id);
        $tuuraSoz=$surot_menen_ish->getKst();
        if($tuuraSoz==$check_soz){
            $count++;
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>"true".$count));
        }else {
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => $count.'|'.$surot_menen_ish->getKst()));
        }

    }


    }