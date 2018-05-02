<?php

namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('position')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id','text',array('header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('name','text',array('label' => 'имя категории',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('position','text',array('label' => 'позиция рисунка',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
//            ->add('imgAktive','string', array(
//                'template' => 'MainBundle:Admin:image_list.html.twig',
//                'label' => 'фото актив',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
//            ))
//            ->add('imgPassive','string', array(
//                'template' => 'MainBundle:Admin:image_list.html.twig',
//                'label' => 'фото пассив',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
//            ))
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
            ->add('name','text',array('label' => 'имя категории','required' => true))
//           // -> add ( 'mediaImgAktive' , ' sonata_type_model ' , array ( ' multiple ' => true ,         )
//            ->add('imgAktive', 'sonata_media_type', array(
//                'label' => 'фото актив',
//                'required' => true,
//                'context' => 'default',
//                'provider' => 'sonata.media.provider.image'
//            ))
//            ->add('imgPassive', 'sonata_media_type', array(
//                'label' => 'фото пассив',
//                'required' => true,
//                'context' => 'default',
//                'provider' => 'sonata.media.provider.image'
//            ))
            ->add('position','text',array('label' => 'позиция рисунка','required' => true))




        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('name','text',array('label' => 'имя категории',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
//            ->add('imgAktive','string', array(
//                'template' => 'MainBundle:Admin:image_list.html.twig',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
//            ))
//            ->add('imgPassive','string', array(
//                'template' => 'MainBundle:Admin:image_list.html.twig',
//                'header_style' => 'width: 5%; text-align: center',
//                'row_align' => 'center'
//            ))
            ->add('position','text',array('label' => 'позиция рисунка',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
        ;
    }
}
