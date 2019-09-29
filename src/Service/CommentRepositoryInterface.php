<?php

namespace App\Service;

use App\Entity\Comment;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repository
 */
interface CommentRepositoryInterface
{
    /**
     * @param int $commentId
     * @return Comment
     */
    public function getComment(int $commentId): ?Comment;

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void;

    /**
     * @param Comment $comment
     */
    public function updateComment(Comment $comment): void;

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment): void;
}
