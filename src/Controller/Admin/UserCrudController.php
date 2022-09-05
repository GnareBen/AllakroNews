<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnDetail()
                ->hideOnIndex(),

            TextField::new('nom')
                ->hideOnIndex(),

            TextField::new('prenoms')
                ->hideOnIndex(),

            TextField::new('username'),

            EmailField::new('email'),

            NumberField::new('number'),

            ChoiceField::new('sexe')
                ->hideOnIndex()
                ->setChoices([
                    'Homme'=>'Homme',
                    'Femme'=>'Femme',
                ]),

            DateField::new('date_naissance'),

            TextareaField::new('description')
                ->hideOnIndex(),

            TextField::new('imageFile')
                ->hideOnIndex()
                ->hideOnDetail()
                ->setFormType(VichImageType::class),

            ImageField::new('image')
                ->hideOnForm()
                ->setBasePath('/uploads/images/users')
                ->setUploadDir('/public/uploads/images/users'),


            ChoiceField::new('roles')
                ->hideOnIndex()
                ->setChoices([
                    'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN',
                    'ROLE_ADMIN'=>'ROLE_ADMIN',
                    'ROLE_USER'=>'ROLE_USER'
                ])
                ->renderExpanded()
                ->allowMultipleChoices(),


            TextField::new('password')
                ->onlyWhenCreating(),

            BooleanField::new('isVerified')
                ->onlyOnIndex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
                return $action->setIcon("fa fa-trash")->addCssClass("btn btn-danger text-white");
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon("fa fa-eye")->setCssClass("btn btn-outline-primary");
            })
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('nom'))
            ->add(TextFilter::new('prenoms'))
            ->add(TextFilter::new('username'))
            ->add(DateTimeFilter::new('created_at'))
            ->add(BooleanFilter::new('isVerified'))
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ;
    }
}
