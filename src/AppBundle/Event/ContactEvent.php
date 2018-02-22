<?php

namespace AppBundle\Event;

use AppBundle\Model\Contact;
use Symfony\Component\EventDispatcher\Event;

class ContactEvent extends Event
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function getContact()
    {
        return $this->contact;
    }
}
