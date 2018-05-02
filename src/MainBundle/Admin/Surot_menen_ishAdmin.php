<?php

namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class Surot_menen_ishAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('oSoz')
           ->add('kst')
           ->add('kSV1')
           ->add('kSV2')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
           /// ->add('id')
           // ->add('oSoz')
           ->add('oSoz','text',array('label' => 'руское слово',  'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'))

            ->add('kst','text',array('label' => 'правильное слово',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('kSV1','text',array('label' => 'первый вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('kSV2','text',array('label' => 'второй вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
           // ->add('kst')
        //    ->add('ksv1')
            ->add('category','text',array('label' => 'катигорий',  'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'))
            ->add('KSTimg','text', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',
                'label' => 'Фото правельного ответа',
                'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'
            ))
            ->add('KSV1img','text', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',
                'label' => 'Фото первого варианта',
                'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'
            ))
            ->add('KSV2img','text', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',
                'label' => 'Фото второго варианта',
                'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'
            ))

            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('id')
            ->add('oSoz','text',array('label' => 'руское слово','required' => true
////            , 'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))

            ->add('kst','text',array('label' => 'правильный слово','required' => true
//            , 'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
            ->add('KSTimg', 'sonata_media_type', array(
                'label' => 'Фото правельного ответа',
                'required' => true,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
            ->add('kSV1','text',array('label' => 'первый вариатн','required' => true
//            , 'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
            ->add('KSV1img', 'sonata_media_type', array(
                'label' => 'Фото первого варианта',
                'required' => true,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
            ->add('kSV2','text',array('label' => 'второй вариант','required' => true
//            , 'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
            ->add('KSV2img', 'sonata_media_type', array(
                'label' => 'Фото второго варианта',
                'required' => true,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
            ))
         //   ->add('kst')
        //    ->add('ksv1')
         ->add('category',null,array('label' => 'категорий'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           // ->add('id')
            ->add('oSoz','text',array('label' => 'руское слово',  'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'))
            ->add('kst','text',array('label' => 'правильное слово',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('KSTimg','string', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',

                'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'
            ))
            ->add('kSV1','text',array('label' => 'слово первого варианта',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('KSV1img','string', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',

                'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'
            ))
            ->add('kSV2','text',array('label' => 'слово второго варианта',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('KSV2img','string', array(
                'template' => 'MainBundle:Admin:image_list.html.twig',
                'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center')

            )

           // ->add('kst')
          //  ->add('ksv1')
            ->add('category','text',array('label' => 'категорий',  'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'))
        ;
    }
}
