<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank(message="app.contact.email.notblank")
     * @Assert\Email(message="app.contact.email.invalidate")
     */
    protected $email;

    protected $title;

    /**
     * @Assert\NotBlank(message="app.contact.content.notblank")
     */
    private $content;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
