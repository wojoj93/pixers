<?php

namespace AppBundle\Mailer;

use AppBundle\Model\Contact;
use Symfony\Component\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface as Templating;
use Symfony\Component\Translation\TranslatorInterface;

class Mailer
{
    private $translator;
    private $templating;
    private $swiftMailer;
    private $fromEmail;
    private $fromName;

    public function __construct(
        TranslatorInterface $translator,
        Templating $templating,
        Router $router,
        \Swift_Mailer $swiftMailer,
        $fromEmail,
        $fromName
    ) {
        $this->translator = $translator;
        $this->templating = $templating;
        $this->swiftMailer = $swiftMailer;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }

    public function sendContactForm(Contact $contact)
    {
        $subject = $this->translator->trans('app.email.contact.default_subject');
        $this->send($contact->getEmail(), $subject, 'Email/contactForm.html.twig', ['contact' => $contact]);
    }

    public function send($email, $subject, $templateName, $parameters = [])
    {
        $message = \Swift_Message::newInstance();
        $message->setSubject($subject);
        $message->setFrom($this->fromEmail, $this->fromName);
        $message->setTo($email);
        $message->setBody($this->templating->render($templateName, $parameters), 'text/html');

        $this->swiftMailer->send($message);
    }
}
