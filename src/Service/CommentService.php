<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Message;

final class CommentService
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository){
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $messageId
     * @param int $commentId
     * @return Comment
     */
    public function getComment(int $messageId, int $commentId): Comment
    {
        $comment = $this->commentRepository->getComment($commentId);
        if ($comment && $comment->getMessage()->getId() !== $messageId) {
            return null;
        }
        return $comment;
    }

    /**
     * @param Message $message
     * @param Comment $comment
     * @return Comment
     */
    public function addComment(Message $message, Comment $comment): Comment
    {
        $comment->setMessage($message);
        $this->commentRepository->addComment($comment);
        return $comment;
    }

    /**
     * @param Message $message
     * @param int $commentId
     * @param Comment $comment
     * @return Comment
     */
    public function updateComment(Message $message, int $commentId, Comment $comment): Comment
    {
        $comment->setId($commentId);
        $comment->setMessage($message);
        $this->commentRepository->updateComment($comment);
        return $comment;
    }

    /**
     * @param int $messageId
     * @param int $commentId
     */
    public function removeComment(int $messageId, int $commentId): void
    {
        $comment = $this->getComment($messageId, $commentId);
        if ($comment !== null) {
            $this->commentRepository->removeComment($comment);
        }
    }
}
