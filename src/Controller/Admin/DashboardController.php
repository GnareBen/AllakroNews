<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Dispensaire;
use App\Entity\Pharmacie;
use App\Entity\Quartier;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
//         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
//         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/custom-page.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');


        yield MenuItem::section(' ', );
        yield MenuItem::subMenu('Articles', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fa fa-file-text', Article::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Commentaire::class),
            MenuItem::linkToCrud('Publier', 'fa fa-edit', Article::class)->setAction('new'),

        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Utilisateurs", "fas fa-user-group")->setSubItems([
            MenuItem::linkToCrud('Tous les utilisateurs', 'fas fa-users', User::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-user-plus', User::class)->setAction('new'),
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Commentaires", "fas fa-comment")->setSubItems([
            MenuItem::linkToCrud('Tous', 'fas fa-comments', Commentaire::class)]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Tags", "fas fa-tag")->setSubItems([
            MenuItem::linkToCrud('Tous les tags', 'fas fa-tags', Tag::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-pen-to-square', Tag::class)->setAction('new')
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Catégorie", "fa-solid fa-pencil")->setSubItems([
            MenuItem::linkToCrud('Toutes les catégories', 'fa-solid fa-pen-field', Category::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-pen-to-square', Category::class)->setAction('new')
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Messages", "fa-solid fa-message")->setSubItems([
            MenuItem::linkToCrud('Tous les messages', 'fa-solid fa-message-text', Contact::class),
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Annonces", "fa-solid fa-microphone")->setSubItems([
            MenuItem::linkToCrud('Toutes les annonces', 'fa-solid fa-microphone-lines', Annonce::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-pen-to-square', Annonce::class)->setAction('new')
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Dispensaire", "fa-solid fa-user-doctor")->setSubItems([
            MenuItem::linkToCrud('Tous les dispensaire', 'fa-solid fa-user-nurse', Dispensaire::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-pen-to-square', Dispensaire::class)->setAction('new')
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Pharmacies", "fa-solid fa-house-medical")->setSubItems([
            MenuItem::linkToCrud('Toutes les pharmacies', 'fa-solid fa-kit-medical', Pharmacie::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-pen-to-square', Pharmacie::class)->setAction('new')
        ]);

        yield MenuItem::section(' ', );
        yield MenuItem::subMenu("Quartier", "fa-solid fa-city")->setSubItems([
            MenuItem::linkToCrud('Tous les quartiers', 'fa-solid fa-tree-city', Quartier::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-pen-to-square', Quartier::class)->setAction('new')
        ]);
    }
}
