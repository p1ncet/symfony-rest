<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Message;
use App\Service\CommentService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Comment controller.
 * @Route("/api/messages/{messageId}/comments", name="comments_")
 */
class CommentController extends AbstractFOSRestController
{
    private $commentService;

    /**
     * CommentController constructor.
     * @param $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Retrieves a collection of Comment resource
     * @Rest\Get("/")
     * @Entity("message", expr="repository.find(messageId)")
     * @param Message $message
     * @return View
     */
    public function getAllComments(Message $message): View
    {
        $comments = $message->getComments();
        return $this->view($comments, Response::HTTP_OK);
    }

    /**
     * Retrieves a Comment resource
     * @Rest\Get("/{commentId}")
     * @param int $messageId
     * @param int $commentId
     * @return View
     */
    public function getComment(int $messageId, int $commentId): View
    {
        $comment = $this->commentService->getComment($messageId, $commentId);
        return $this->view($comment, Response::HTTP_OK);
    }

    /**
     * Creates a Comment resource
     * @Rest\Post("/")
     * @Entity("message", expr="repository.find(messageId)")
     * @ParamConverter("comment", converter="fos_rest.request_body")
     * @param Message $message
     * @param Comment $comment
     * @return View
     */
    public function addComment(Message $message, Comment $comment): View
    {
        $comment = $this->commentService->addComment($message, $comment);
        return $this->view($comment, Response::HTTP_CREATED);
    }

    /**
     * Replaces Comment resource
     * @Rest\Put("/{commentId}")
     * @Entity("message", expr="repository.find(messageId)")
     * @ParamConverter("comment", converter="fos_rest.request_body")
     * @param Message $message
     * @param int $commentId
     * @param Comment $comment
     * @return View
     */
    public function updateComment(Message $message, int $commentId, Comment $comment): View
    {
        $comment = $this->commentService->updateComment($message, $commentId, $comment);
        return $this->view($comment, Response::HTTP_OK);
    }

    /**
     * Removes the Comment resource
     * @Rest\Delete("/{commentId}")
     * @param int $messageId
     * @param int $commentId
     * @return View
     */
    public function deleteComment(int $messageId, int $commentId): View
    {
        $this->commentService->removeComment($messageId, $commentId);
        return $this->view([], Response::HTTP_NO_CONTENT);
    }
}
