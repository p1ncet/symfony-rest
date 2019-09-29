<?php

namespace App\Service;

use App\Entity\Message;

/**
 * Interface MessageRepositoryInterface
 * @package App\Repository
 */
interface MessageRepositoryInterface
{
    /**
     * @return Message[]
     */
    public function getAllMessages(): array;

    /**
     * @param int $messageId
     * @return Message
     */
    public function getMessage(int $messageId): ?Message;

    /**
     * @param Message $message
     */
    public function addMessage(Message $message): void;

    /**
     * @param Message $message
     */
    public function updateMessage(Message $message): void;

    /**
     * @param Message $message
     */
    public function removeMessage(Message $message): void;
}
