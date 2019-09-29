<?php

namespace App\Tests\Stubs;

use App\Entity\Comment;
use App\Service\CommentRepositoryInterface;

class InMemoryCommentRepository implements CommentRepositoryInterface
{
    private $comments = [];

    /**
     * @return Comment[]
     */
    public function getAllComments(): array
    {
        return $this->comments;
    }

    /**
     * @param int $commentId
     * @return Comment
     */
    public function getComment(int $commentId): ?Comment
    {
        return $this->comments[$commentId] ?? null;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void
    {
        $comment->setId(count($this->comments) + 1);
        $this->comments[$comment->getId()] = $comment;
    }

    /**
     * @param Comment $comment
     */
    public function updateComment(Comment $comment): void
    {
        $this->comments[$comment->getId()] = $comment;
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment): void
    {
        unset($this->comments[$comment->getId()]);
    }
}
