<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="date")
     */
    private $creation;

    /**
     * @var string
     *
     * @ORM\Column(name="autheur", type="string", length=255)
     */
    private $autheur;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var Topic
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Topic",inversedBy="posts")
     *
     */
    private $topic;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creation
     *
     * @param \DateTime $creation
     *
     * @return Post
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * Get creation
     *
     * @return \DateTime
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * Set autheur
     *
     * @param string $autheur
     *
     * @return Post
     */
    public function setAutheur($autheur)
    {
        $this->autheur = $autheur;

        return $this;
    }

    /**
     * Get autheur
     *
     * @return string
     */
    public function getAutheur()
    {
        return $this->autheur;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Post
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return Topic
     */
    public function getTopic(): Topic
    {
        return $this->topic;
    }

    /**
     * @param Topic $topic
     */
    public function setTopic(Topic $topic)
    {
        $this->topic = $topic;
    }
}

