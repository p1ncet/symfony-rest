<?php

namespace App\Service;

use App\Entity\Message;

final class MessageService
{
    private $messageRepository;
    private $commentRepository;

    public function __construct(MessageRepositoryInterface $messageRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return Message[]
     */
    public function getAllMessages(): array
    {
        return $this->messageRepository->getAllMessages();
    }

    /**
     * @param int $messageId
     * @return Message
     */
    public function getMessage(int $messageId): ?Message
    {
        return $this->messageRepository->getMessage($messageId);
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function addMessage(Message $message): Message
    {
        $this->messageRepository->addMessage($message);
        return $message;
    }

    /**
     * @param int $messageId
     * @param Message $message
     * @return Message
     */
    public function updateMessage(int $messageId, Message $message): Message
    {
        $message->setId($messageId);
        $this->messageRepository->updateMessage($message);
        return $message;
    }

    /**
     * @Transactional
     * @param int $messageId
     */
    public function removeMessage(int $messageId): void
    {
        $message = $this->getMessage($messageId);
        if ($message !== null) {
            foreach ($message->getComments() as $comment) {
                $this->commentRepository->removeComment($comment);
            }
            $this->messageRepository->removeMessage($message);
        }
    }
}
