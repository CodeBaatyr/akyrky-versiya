<?php
/**
 * Created by PhpStorm.
 * User: тойчубек
 * Date: 06.04.2018
 * Time: 15:28
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


class bolum__testController  extends Controller
{


    /**
     * @Route("/start_bolum__test/{cat_id}", options={"expose"=true}, name="start_bolum__test")
     */
    public function start_bolum__testAction($cat_id)
    {
        $category = $this->getDoctrine()->getRepository('MainBundle:Category')->find($cat_id);
        $bolum__test= $category->getTest();
        if(empty($bolum__test[0])){
            return new Response(
                '<html><body> этот раздел не создан пожайлуста добавьте этот раздел в базу  </body></html>'
            );

        }else

        return $this->redirectToRoute('show_bolum__test', array('cat_id' =>$cat_id ,'id'=>$bolum__test[0]->getId(),'count'=>0
        ,'totalCount'=>count($bolum__test),'counter'=>1));
    }
    /**
     * @Route("/next_bolum__test", options={"expose"=true}, name="next_bolum__test")
     */
    public function next_bolum__testAction()
    {
        $suylom_id =$_POST["suylom_id"];
        $category_id=$_POST["category_id"];
        $countOfTrueVariant=$_POST["count"];

        $bolum__test=$this->getDoctrine()->getRepository('MainBundle:Test')->
        findBy(array('category' => $category_id));

        $count=count($bolum__test);
        $lastId=$bolum__test[$count-1]->getId();
        $finish=0;
        $var=true;
        if ($lastId==$suylom_id)
            $finish=1;

        if ($finish==0) {

            $suylom_id++;
            while ($var) {
                $test= $this->getDoctrine()->getRepository('MainBundle:Test')->
                findOneBy(array('id' => $suylom_id, 'category' => $category_id));


                if (!empty($test)) {
                    $var = false;
                } else {

                    $suylom_id++;


                }
            }
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => $test->getId()));

        }
        else {
            $prozent=($countOfTrueVariant*100)/$count;

           if ($prozent>=90)
               $baa='Превосходно!!!|Вы ответили '.$prozent.'% верно';
           else if($prozent>=70)
               $baa='Вы молодец!!!|Вы ответили '.$prozent.'% верно';
           else if($prozent>=50)
               $baa='Старайтесь еще лучьше!!!|Вы ответили '.$prozent.'% верно';
           else if($prozent>0) $baa='По больше занимайтесь|Вы ответили '.$prozent.'% верно';
           else $baa='Очень жаль!!!|Вы не ответили ни одного правильного ответа';
            $kiyinkiCategory='.0';


         if ($prozent>=60){

             $user = $this->getDoctrine()->getRepository('MainBundle:User') ->findOneBy(array('id' =>$_SESSION['id']));
             //профиль башы

             $profile=$user->getProfile();




             if(isset($profile[(int)$category_id]['test'])){  //ушундай индекси бар болсо жана null эмес болсо
                 $profile[(int)$category_id]['test']=$prozent*0.6;
                 $profile[(int)$category_id]['jalpy']=$profile[(int)$category_id]['test']
                 +$profile[(int)$category_id]['kotor']
                 +$profile[(int)$category_id]['soz'];

             } else{
                 $profile[(int)$category_id]['test']=$prozent*0.6;

                 $profile[(int)$category_id]['jalpy']=$profile[(int)$category_id]['test']  +$profile[(int)$category_id]['kotor'] +$profile[(int)$category_id]['soz'];


                 $profile[(int)$category_id]['dayarBy']=true;


             }

             $user->setProfile( $profile);
             //профиль аягы
             //сактоо
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();
             //профиль аягы

             $id=$user->getCount();


             $category= $this->getDoctrine()->getRepository('MainBundle:Category')->findAll();
             $count_category=count( $category);
             $lastIdCategory=$category[$count_category-1]->getId();
             $finishCategory=0;
             $var=true;
             if ($lastIdCategory==$category_id)
                 $finishCategory=1;
           if ($finishCategory==0){
             if ($category_id>=$id){
                     $id++;
                     while ($var) {
                         $category = $this->getDoctrine()->getRepository('MainBundle:Category')->
                         findOneBy(array('id' => $id));


                         if (!empty($category)) {
                             $var = false;
                         } else {

                             $id++;


                         }

                     }
                      $user->setCount($id);
                 //КИЙИНКИ КАТЕГОРИЯНЫН АКТИВ БОЛУМУН ЖАУЗУУ
                      $bolum = $user->getBolum();
                      $bolum[(int)$id] =1;
                      $user->setBolum($bolum);

                      //сактоо
                      $entityManager = $this->getDoctrine()->getManager();
                      $entityManager->persist($user);
                      $entityManager->flush();
                      //кийинки категория атын чыгаруу
                 $category = $this->getDoctrine()->getRepository('MainBundle:Category')->
                 findOneBy(array('id' => $id));
                 $kiyinkiCategory='.'.$category->getName();





                 }



             }

          }
            return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' => '-1'.$baa.$kiyinkiCategory));
        }

    }



    /**
     * @Route("/show_bolum__test/{cat_id}/{id}/{count}/{totalCount}/{counter}", options={"expose"=true}, name="show_bolum__test")
     */
    public function show_bolum__testAction($cat_id,$id,$count,$totalCount,$counter)
    {
        if (isset($_SESSION['id'])){
        $bolum__test=$this->getDoctrine()->getRepository('MainBundle:Test')->
        findOneBy(array('id' => $id, 'category' => $cat_id));

        if (!empty($bolum__test) ){

            $suylom=$bolum__test->getKSuy();
            $suylom=trim($suylom);
           if($pos=strripos($suylom, '.')) {

               $suylom[$pos]=' ';
               $suylom[$pos+1]='.';
               $puntktution=true;

           }else  if ($pos=strripos($suylom, '?')){

               $suylom[$pos]=' ';
               $suylom[$pos+1]='?';
               $puntktution=true;
           }
           else if($pos=strripos($suylom, '!')){
               $suylom[$pos]=' ';
               $suylom[$pos+1]='!';
               $puntktution=true;
           }else{
               $puntktution=false;
           }

         if ($puntktution){

             $suylom = preg_split("/[\s\,,]+/",$suylom);
             $index = rand(0,count($suylom)-2);


         }else {
             $suylom = preg_split("/[\s\,,]+/",$suylom);
             $index = rand(0,count($suylom)-1);

         }

            $variant = array($suylom[$index], $bolum__test->getSozV1(), $bolum__test->getSozV2(),$bolum__test->getSozV3());
            shuffle($variant);
            $suylom[$index]="...";


            return $this->render('MainBundle:Bolum:bolum__test.htm.twig'
                ,array('suylom'=>$suylom,
                'varuant'=>$variant,'tuura_variant_index'=>$index,
                'bolum__test'=>$bolum__test,'count'=>$count
                ,'isNotIndexPage'=>true,
                    'bolum'=>$cat_id,
                    'totalCount'=>$totalCount,
                    'counter'=>$counter
                ));
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
     * @Route("/bolum__test_check_variant/{count}", options={"expose"=true}, name="bolum__test_check_variant")
     */
    public function bolum__test_check_variantAction($count)
    {

       $select_variant= $_POST["select_variant"];
       $suylom_id= $_POST["suylom_id"];
       $category_id=$_POST["category_id"];
       $tuura_variant_index= $_POST["tuura_variant_index"];
       $suylom = $this->getDoctrine()->getRepository('MainBundle:Test')->
        findOneBy(array('id' => $suylom_id, 'category' => $category_id));
       if (!empty($suylom)){
           $suylom=$suylom->getKSuy();
           $suylom=trim($suylom);
           if($pos=strripos($suylom, '.')) {

               $suylom[$pos]=' ';
               $suylom[$pos+1]='.';

           }
           if ($pos=strripos($suylom, '?')){

               $suylom[$pos]=' ';
               $suylom[$pos+1]='?';

           }
           if($pos=strripos($suylom, '!')){
               $suylom[$pos]=' ';
               $suylom[$pos+1]='!';

           }



               $suylom = preg_split("/[\s\,,]+/",$suylom);
               if ($suylom[$tuura_variant_index]==$select_variant){
                   $count++;
                   return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>'true'.$count));
               }else{
                   return $this->render('MainBundle:Assistant:checker.html.twig', array('checker' =>$count.'|'.$suylom[$tuura_variant_index]));
               }








       }




    }





}