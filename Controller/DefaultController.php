<?php

namespace FDevs\ContactUsBundle\Controller;

use FDevs\ContactUsBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $mm = $this->container->get('f_devs_contact_us.message_manager');
        $message = $mm->create();
        $message->setClientIp($request->getClientIp());
        $error = [];
        $response = null;
        $formType = $this->container->getParameter('f_devs_contact_us.form_type');
        $formAction = $this->container->getParameter('f_devs_contact_us.form_action');
        $form = $this->createForm($formType, $message, [
            'action' => $this->generateUrl($formAction),
            'attr'   => ['id' => $formType]
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $error = $mm->save($message);
            if (!count($error)) {
                $response = new JsonResponse([
                    'status'  => 'ok',
                    'message' => $this->get('translator.default')->trans('form.success', [], 'FDevsContactUsBundle'),
                ]);
            }
        } elseif ($form->isSubmitted()) {
            $error = $this->getErrors($form);
        }

        if (count($error)) {
            $response = new JsonResponse(['status' => 'error', 'error' => $this->getErrors($form)]);
        }

        return $response ?: $this->render('FDevsContactUsBundle:Default:index.html.twig', ['form' => $form->createView()]);
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
