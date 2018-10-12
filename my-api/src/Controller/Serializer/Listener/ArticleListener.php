<?php

namespace App\Serializer\Listener;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\ObjectEvent;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;

class ArticleListener implements EventSubscriberInterface
{
    public static function getSubscribeEvents()
    {
        return [
            [
                'event' =>Events::POST_SERIALIZE,
                'format' =>'json',
                'class' => 'App\Entity\Arcticle',
                'method' => 'onPostSerialize'
            ]

        ];
    }

    public static function OnPostSerialize(ObejectEvent $event){
        $date = new Datetime();
        $event->getVisitor()->addData('serialized_at', $date->format('l js\of F Y h:i:s A'));

    }
}
