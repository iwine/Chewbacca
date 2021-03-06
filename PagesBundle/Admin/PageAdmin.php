<?php
namespace Chewbacca\PagesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class PageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category', null, array('label' => 'Родитель'
                                          , 'required'=>true
                                          /*, 'query_builder' => function($er) use ($id) {
                                                $qb = $er->createQueryBuilder('p');
                                                if ($id) {
                                                    $qb
                                                        ->where('p.id <> :id')
                                                        ->setParameter('id', $id);
                                                }
                                                $qb
                                                    ->orderBy('p.root, p.lft', 'ASC');

                                                return $qb;
                                            }*/
                    ))
            ->add('title')
            ->add('content')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            //->add('category')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('created')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
                ->assertMaxLength(array('limit' => 72))
            ->end()
        ;
    }
}
