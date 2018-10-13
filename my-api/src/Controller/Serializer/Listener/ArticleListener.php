<?php

namespace App\Controller\Serializer\Listener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class ArticleListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => Events::POST_SERIALIZE,
                'format' => 'json',
                'class' => 'App\Entity\Article',
                'method' => 'onPostSerialize',
            ]
        ];
    }

    public static function onPostSerialize(ObjectEvent $event)
    {
        $date = new \Datetime();
        // Possibilité de modifier le tableau après sérialisation
        $event->getVisitor()->addData("delivered_at", json_decode($date->format("l jS \of F Y h:i:s A")));
    }
}