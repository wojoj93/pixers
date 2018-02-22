<?php

namespace AppBundle\Controller;

use AppBundle\Event\ContactEvent;
use AppBundle\Event\UserEvents;
use AppBundle\Form\Type\ContactFormType;
use AppBundle\Model\Contact;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiController extends FOSRestController
{
    /**
     * @Route(name="api.contact.send", path="/api/contact/send")
     * @Method("POST")
     * @View()
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     * @ApiDoc(
     *  name="Send contact", section="Contact",
     *  description="Send contact",
     *  parameters={
     *      {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *      {"name"="title", "dataType"="string", "required"=false, "description"="title"},
     *      {"name"="content", "dataType"="string", "required"=true, "description"="content"},
     *  }
     * )
     */
    public function testProgressAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->get('form.factory')
            ->createNamed(
                null,
                ContactFormType::class,
                $contact,
                [
                    'csrf_protection' => false,
                ]
            );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get('event_dispatcher')->dispatch(UserEvents::CONTACT_SENT, new ContactEvent($contact));

            return $this->view(['success' => true]);
        }

        return $this->view($form, Response::HTTP_BAD_REQUEST);
    }
}
