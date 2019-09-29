<?php

namespace App\Tests\Stubs;

use App\Entity\Message;
use App\Service\MessageRepositoryInterface;

class InMemoryMessageRepository implements MessageRepositoryInterface
{
    private $messages = [];

    /**
     * @return Message[]
     */
    public function getAllMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param int $messageId
     * @return Message
     */
    public function getMessage(int $messageId): ?Message
    {
        return $this->messages[$messageId] ?? null;
    }

    /**
     * @param Message $message
     */
    public function addMessage(Message $message): void
    {
        $message->setId(count($this->messages) + 1);
        $this->messages[$message->getId()] = $message;
    }

    /**
     * @param Message $message
     */
    public function updateMessage(Message $message): void
    {
        $this->messages[$message->getId()] = $message;
    }

    /**
     * @param Message $message
     */
    public function removeMessage(Message $message): void
    {
        unset($this->messages[$message->getId()]);
    }
}
