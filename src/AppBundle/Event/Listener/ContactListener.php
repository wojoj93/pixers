<?php

namespace AppBundle\Event\Listener;

use AppBundle\Event\ContactEvent;
use AppBundle\Mailer\Mailer;

class ContactListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onSendContact(ContactEvent $event)
    {
        $this->mailer->sendContactForm($event->getContact());
    }
}
