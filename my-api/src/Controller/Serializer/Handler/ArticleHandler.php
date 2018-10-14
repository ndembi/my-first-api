<?php

namespace App\Controller\Serializer\Handler;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\Context;
use App\Entity\Article;

class ArticleHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods(){

        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'App\Entity\Article',
                'method' =>'serialize'
            ]
        ];
    }

    public function serialize(JsonSerializationVisitor $visitor, Article $article, 
    array $type, Context $context){
        $date = new \Datetime();
        return [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'serialized_at' => $date->format("l jS \of F Y h:i:s A")

        ];

    }
}
