<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre', 'Titre')
                ->setColumns(6),

            SlugField::new('slug', 'Slug')
                ->setTargetFieldName("titre")
                ->setColumns(6)
                ->hideOnIndex(),

            AssociationField::new('category', 'Catégorie')
                ->setColumns(6),

            AssociationField::new('tag', 'Tag')
                ->autocomplete()
                ->setColumns(6),

            TextField::new('imageFile', 'Image')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),

            ImageField::new('image', 'Image')
                ->setBasePath('/uploads/images/articles')
                ->setUploadDir('/public/uploads/images/articles')
                ->hideOnForm(),

            TextEditorField::new('contenu', 'Contenu')
                ->hideOnIndex()
                 ->setColumns(12),

            AssociationField::new('user', 'Auteurs')
                ->onlyOnIndex(),

            DateTimeField::new('created_at', 'Date de création')
                ->onlyOnIndex(),

            BooleanField::new('is_valid', 'Valide')
                ->onlyOnIndex(),

            BooleanField::new('is_published', 'Publié')
                ->onlyOnIndex(),

        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
                return $action->setIcon("fa fa-trash")->setCssClass("btn btn-danger");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action){
                return $action->setIcon("fa fa-edit")->setCssClass("btn btn-secondary");
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon("fa fa-eye")->setCssClass("btn btn-primary");
            })
            ->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add(TextFilter::new('Titre'))
            ->add(TextFilter::new('user'))
            ->add(DateTimeFilter::new('created_at'))
            ->add(DateTimeFilter::new('updated_at'))
            ->add(BooleanFilter::new('is_published'))
            ->add(BooleanFilter::new('is_valid'))
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

}
