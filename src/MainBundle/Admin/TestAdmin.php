<?php

namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TestAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('kSuy')
            ->add('sozV1')
            ->add('sozV2')
            ->add('sozV3')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('kSuy','text',array('label' => 'кыргызское предложение',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('sozV1','text',array('label' => '1-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('sozV2','text',array('label' => '2-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('sozV3','text',array('label' => '3-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('category','text',array('label' => 'катигорий',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
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
            ->add('kSuy','text',array('label' => 'кыргызское предложение','required' => true

            ))
            ->add('sozV1','text',array('label' => '1-вариант','required' => true

            ))
            ->add('sozV2','text',array('label' => '2-вариант','required' => true

            ))
            ->add('sozV3','text',array('label' => '3-вариант','required' => true

            ))
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
            ->add('kSuy','text',array('label' => 'кыргызское предложение',  'header_style' => 'width: 5%; text-align: center',
               'row_align' => 'center'))
            ->add('sozV1','text',array('label' => '1-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('sozV2','text',array('label' => '2-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('sozV3','text',array('label' => '3-вариант',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
            ->add('category','text',array('label' => 'категорий',  'header_style' => 'width: 5%; text-align: center',
                'row_align' => 'center'))
        ;
    }
}
