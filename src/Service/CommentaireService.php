<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;


class CommentaireService
{
    private  $entitymanager;

    public function __construct(EntityManagerInterface $entitymanager,)
    {
        $this->entitymanager = $entitymanager;
    }

    public function persistCommentaire(Commentaire $commentaire, Article $article , CommentaireRepository $commentaireRepository , Security $security): void
    {
        $user = $security->getUser();

        $commentaire->setUser($user);
        $commentaire->setArticle($article);
        $commentaireRepository->add($commentaire, true);
    }
}