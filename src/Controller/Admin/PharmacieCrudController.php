<?php

namespace App\Controller\Admin;

use App\Entity\Pharmacie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PharmacieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pharmacie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            AssociationField::new('quartier')->setProperty('quartier'),
            TextField::new('contact'),
            TextField::new('imageFile')
                ->hideOnIndex()
                ->hideOnDetail()
                ->setFormType(VichImageType::class),

            ImageField::new('image')
                ->hideOnForm()
                ->setBasePath('/uploads/images/pharmacies')
                ->setUploadDir('/public/uploads/images/pharmacies'),
            BooleanField::new('de_garde')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
                return $action->setIcon("fa fa-trash")->addCssClass("btn btn-danger text-white");
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon("fa fa-eye")->setCssClass("btn btn-primary");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action){
                return $action->setIcon("fa fa-edit")->setCssClass("btn btn-success");
            })
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ;
    }
}
