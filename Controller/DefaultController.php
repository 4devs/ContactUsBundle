<?php

namespace FDevs\ContactUsBundle\Controller;

use FDevs\ContactUsBundle\Form\Type\MessageType;
use FDevs\ContactUsBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $message = new Message($request->getClientIp());
        $formType = new MessageType();
        $form = $this->createForm(
            $formType,
            $message,
            ['action' => $this->generateUrl('f_devs_contact_us_form'), 'attr' => ['id' => $formType->getName()]]
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->container->get('f_devs_contact_us.message_manager')->create($message);

            return new JsonResponse(
                [
                    'status' => 'ok',
                    'message' => $this->get('translator.default')->trans('form.success', [], 'FDevsContactUsBundle')
                ]
            );
        } elseif ($form->isSubmitted()) {
            return new JsonResponse(['status' => 'error', 'error' => $this->getErrors($form)]);
        }

        return $this->render('FDevsContactUsBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

    private function getErrors(Form $form)
    {
        $errors = [];
        foreach ($form as $fieldName => $formField) {
            $fieldError = $formField->getErrors();
            if (count($fieldError)) {
                foreach ($fieldError as $value) {
                    $errors[$fieldName][] = $value->getMessage();
                }
            }
        }

        return $errors;

    }
}
