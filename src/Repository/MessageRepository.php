<?php

namespace App\Repository;

use App\Entity\Message;
use App\Service\MessageRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class MessageRepository
 * @package App\Repository
 */
final class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MessageRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Message[]
     */
    public function getAllMessages(): array
    {
        return $this->entityManager->getRepository(Message::class)->findAll();
    }

    /**
     * @param int $messageId
     * @return Message
     */
    public function getMessage(int $messageId): ?Message
    {
        /** @var Message $message */
        $message = $this->entityManager->find(Message::class, $messageId);
        return $message;
    }

    /**
     * @param Message $message
     */
    public function addMessage(Message $message): void
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }

    /**
     * @param Message $message
     */
    public function updateMessage(Message $message): void
    {
        $this->entityManager->merge($message);
        $this->entityManager->flush();
    }

    /**
     * @param Message $message
     */
    public function removeMessage(Message $message): void
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }
}
