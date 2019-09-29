<?php

namespace App\Controller;

use App\Entity\Message;
use App\Service\MessageService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Message controller.
 * @Route("/api/messages", name="api_")
 */
class MessageController extends AbstractFOSRestController
{
    private $messageService;

    /**
     * MessageController constructor.
     * @param $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Retrieves a collection of Message resource
     * @Rest\Get("/")
     * @return View
     */
    public function getAllMessages(): View
    {
        $messages = $this->messageService->getAllMessages();
        return $this->view($messages, Response::HTTP_OK);
    }

    /**
     * Retrieves a Message resource
     * @Rest\Get("/{messageId}")
     * @param int $messageId
     * @return View
     */
    public function getMessage(int $messageId): View
    {
        $message = $this->messageService->getMessage($messageId);
        return $this->view($message, Response::HTTP_OK);
    }

    /**
     * Creates a Message resource
     * @Rest\Post("/")
     * @ParamConverter("message", converter="fos_rest.request_body")
     * @param Message $message
     * @return View
     */
    public function addMessage(Message $message): View
    {
        $message = $this->messageService->addMessage($message);
        return $this->view($message, Response::HTTP_CREATED);
    }

    /**
     * Replaces Message resource
     * @Rest\Put("/{messageId}")
     * @ParamConverter("message", converter="fos_rest.request_body")
     * @param int $messageId
     * @param Message $message
     * @return View
     */
    public function updateMessage(int $messageId, Message $message): View
    {
        $message = $this->messageService->updateMessage($messageId, $message);
        return $this->view($message, Response::HTTP_OK);
    }

    /**
     * Removes the Message resource
     * @Rest\Delete("/{messageId}")
     * @param int $messageId
     * @return View
     */
    public function deleteMessage(int $messageId): View
    {
        $this->messageService->removeMessage($messageId);
        return $this->view([], Response::HTTP_NO_CONTENT);
    }
}
