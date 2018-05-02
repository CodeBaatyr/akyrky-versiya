<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 04.04.2018
 * Time: 17:33
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


class suylomController extends Controller
{

    /**
     * @Route("/start_suylom/{cat_id}", options={"expose"=true}, name="start_suylom")
     */
    public function start_suylomAction($cat_id)
    {
        $category_id=$cat_id;
        $category = $this->getDoctrine()->getRepository('MainBundle:Category')->find($cat_id);
        $suylom = $category->getSuylomKotoru();
        if(empty($suylom[0])){
            return new Response(
                '<html><body> этот раздел не создан пожайлуста добавьте этот раздел в базу  </body></html>'
            );

        }else{
            return $this->redirectToRoute('show_suylom', array('cat_id' =>$category_id ,'id'=>$suylom[0]->getId(),'count'=>0
            ,'totalCount'=>count($suylom),'counter'=>1));

        }


    }
    /**
     * @Route("/next_suylom/{countTrue}", options={"expose"=true}, name="next_suylom")
     */
    public function next_suylomAction($countTrue)
    {
        $suylom_id =$_POST["suylom_id"];
        $category_id=$_POST["category_id"];
        $var=true;

       $suylom_kotoru = $this->getDoctrine()->getRepository('MainBundle:Suylom_kotoru')->findBy(array('category' => $category_id));
       $count=count($suylom_kotoru);
        $lastId=$suylom_kotoru[$count-1]->getId();
        $finish=0;
        if ($lastId==$suylom_id)
           $finish=1;

      if ($finish==0) {

            $suylom_id++;
            while ($var) {
                $suylom_kotoru = $this->getDoctrine()->getRepository('MainBundle:Suylom_kotoru')->
                findOneBy(array('id' => $suylom_id, 'category' => $category_id));


                if (!empty($suylom_kotoru)) {
                    $var = false;
                } else {

                    $suylom_id++;


                }
            }
        return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => $suylom_kotoru->getId()));

           }
      else{

          $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));
          $prozent=($countTrue*100)/$count;
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
              if ( $bolum[(int)$category_id]<3 ){
                  $kiyinkibolum='.1';
                  $bolum[(int)$category_id] =3;
                  $user->setBolum($bolum);


              }
              //кийинки болумдуу ачуу аягы
              //профил башы
              $profile=$user->getProfile();
              if(isset($profile[(int)$category_id]['test'])){//ушундай индекси бар болсо жана null эмес болсо
                  $profile[(int)$category_id]['jalpy']=$profile[(int)$category_id]['test'] +$profile[(int)$category_id]['kotor'] +$profile[(int)$category_id]['soz'];

              }else{
                  $profile[(int)$category_id]['kotor']=$prozent*0.2;

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
     * @Route("/show_suylom/{cat_id}/{id}/{count}/{totalCount}/{counter}", options={"expose"=true}, name="show_suylom")
     */
    public function show_suylomAction($cat_id,$id,$count,$totalCount,$counter)
    {
        if(isset($_SESSION['id'])){
            $id=(int)$id;
            $suylom_kotoru = $this->getDoctrine()->getRepository('MainBundle:Suylom_kotoru')->
            findOneBy(array('id' => $id, 'category' => $cat_id));


            if (!empty($suylom_kotoru)) {

                return $this->render('MainBundle:Bolum:suylom.html.twig',array('suylom_kotoru'=>$suylom_kotoru,
                    'count'=>$count
                    ,'isNotIndexPage'=>true,
                    'bolum'=>$cat_id,
                    'totalCount'=>$totalCount,
                    'counter'=>$counter));

            }else{
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
     * @Route("/check_suylom/{countTrue}", options={"expose"=true}, name="check_suylom")
     */
    public function check_suylomAction($countTrue)
    {

        $input_suylom =$_POST["input_suylom"];
        $suylom_id =$_POST["suylom_id"];
        $input_suylom=trim($input_suylom);
        $input_suylom=mb_strtolower($input_suylom);
        $suylom='';
        $input_suylom = preg_split("/[\s\?\.\!,]+/",$input_suylom);

        $suylom_kotoru = $this->getDoctrine()->getRepository('MainBundle:Suylom_kotoru')->find($suylom_id);
        $oruscha_suylom=$suylom_kotoru->getOSuy();

        $oruscha_suylom=trim($oruscha_suylom);
        $oruscha_suylom=mb_strtolower($oruscha_suylom);
        $suylom_data_base='';
        $oruscha_suylom = preg_split("/[\s\?\.\,\!,]+/",$oruscha_suylom);

        $count_data_base=count($oruscha_suylom);
        $count=count($input_suylom);

        for ($i=0;$i<$count;$i++){
            if ($count-1==$i)
                $suylom.=$input_suylom[$i];
            else
            $suylom.=$input_suylom[$i].' ';

        }

        for ($i=0;$i<$count_data_base;$i++){
            if ($count_data_base-1==$i)
                $suylom_data_base.=$oruscha_suylom[$i];
            else
                $suylom_data_base.=$oruscha_suylom[$i].' ';

        }




        if($suylom_data_base==$suylom ){
            $countTrue++;
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>'true'.$countTrue));
        }else {
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>$countTrue.'|'.$suylom_kotoru->getOSuy()));
        }

    }



}