<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnnonceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonce::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextEditorField::new('contenu'),
            TextField::new('imageFile', 'Image')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
            ImageField::new('image', 'Image')
                ->setBasePath('/uploads/images/annonces')
                ->setUploadDir('/public/uploads/images/annonces')
                ->hideOnForm(),
            BooleanField::new('is_valid', 'Valide')->hideOnForm(),
            BooleanField::new('is_published', 'Publié')->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
                return $action->setIcon("fa fa-trash")->addCssClass("btn btn-danger");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action){
                return $action->setIcon("fa fa-edit")->setCssClass("btn btn-secondary");
            })
            ->add(Crud::PAGE_INDEX, Action::DETAIL)

            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon("fa fa-eye")->setCssClass("btn btn-primary");
            })
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setDefaultSort(['updated_at'=>'DESC']);
    }
}
