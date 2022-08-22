<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\Security\Core\Security;


class EasyAdminSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setArticleDate'],
            BeforeEntityUpdatedEvent::class => ['setArticleUpdate']
        ];
    }

    public function setArticleDate(BeforeEntityPersistedEvent $event)
    {
        $user = $this->security->getUser();

        $entity = $event->getEntityInstance();
        if (!($entity instanceof Article)){
            return;
        }

        $entity->setCreatedAt(new \DateTimeImmutable())
            ->setUser($user);
    }

    public function setArticleUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Article)){
            return;
        }

        $user =$this->security->getUser();
        $entity->setUpdatedAt(new \DateTimeImmutable())
            ->setUser($user);
    }
}