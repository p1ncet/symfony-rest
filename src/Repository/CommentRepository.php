<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Service\CommentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CommentRepository
 * @package App\Repository
 */
final class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CommentRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $commentId
     * @return Comment
     */
    public function getComment(int $commentId): ?Comment
    {
        /** @var Comment $comment */
        $comment = $this->entityManager->find(Comment::class, $commentId);
        return $comment;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    /**
     * @param Comment $comment
     */
    public function updateComment(Comment $comment): void
    {
        $this->entityManager->merge($comment);
        $this->entityManager->flush();
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment): void
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}
