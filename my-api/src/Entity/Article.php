<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Article
{
    /**
     * @JMS\Serializer\Annotation\Type("integer")
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Serializer\Annotation\Groups({"list"})
     */
    private $id;

    /**
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(type="string", length=100)
     * @JMS\Serializer\Annotation\Groups({"list","detail"})
     */
    private $title;

    /**
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(type="text")
     * @JMS\Serializer\Annotation\Groups({"list","detail"})
     */
    private $content;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}