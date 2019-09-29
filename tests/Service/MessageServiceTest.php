<?php

namespace App\Tests\Service;

use App\Entity\Message;
use App\Service\MessageService;
use App\Tests\Stubs\InMemoryCommentRepository;
use App\Tests\Stubs\InMemoryMessageRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class MessageServiceTest extends TestCase
{
    /**
     * @covers \App\Service\MessageService::getMessage
     */
    public function testGetMessage(): void
    {
        $messageRepository = new InMemoryMessageRepository();
        $commentRepository = new InMemoryCommentRepository();
        $messageService = new MessageService($messageRepository, $commentRepository);

        $message1 = new Message();
        $message1->setAuthor("me");
        $message1->setMessage("test");
        $messageRepository->addMessage($message1);

        $this->assertSame($message1, $messageService->getMessage(1));
    }

    /**
     * @covers \App\Service\MessageService::addMessage
     */
    public function testAddMessage(): void
    {
        $messageRepository = new InMemoryMessageRepository();
        $commentRepository = new InMemoryCommentRepository();
        $messageService = new MessageService($messageRepository, $commentRepository);

        $message1 = new Message();
        $message1->setAuthor("me");
        $message1->setMessage("first");
        $newMessage1 = $messageService->addMessage($message1);
        $this->assertSame(1, $newMessage1->getId());

        $message2 = new Message();
        $message2->setAuthor("me");
        $message2->setMessage("second");
        $newMessage2 = $messageService->addMessage($message2);

        $this->assertSame(2, $newMessage2->getId());
        $this->assertSame([1 => $newMessage1, 2 => $newMessage2], $messageRepository->getAllMessages());
        $this->assertTrue(true);
    }

    /**
     * @covers \App\Service\MessageService::updateMessage
     */
    public function testUpdateMessage(): void
    {
        $messageRepository = new InMemoryMessageRepository();
        $commentRepository = new InMemoryCommentRepository();
        $messageService = new MessageService($messageRepository, $commentRepository);

        $message = new Message();
        $message->setAuthor("me");
        $message->setMessage("first");
        $messageRepository->addMessage($message);

        $updatedMessage = new Message();
        $updatedMessage->setMessage("updated");
        $messageService->updateMessage(1, $updatedMessage);

        $this->assertSame("updated", $messageService->getMessage(1)->getMessage());
    }

    /**
     * @covers \App\Service\MessageService::removeMessage
     */
    public function testRemoveMessage(): void
    {
        $messageRepository = new InMemoryMessageRepository();
        $commentRepository = new InMemoryCommentRepository();
        $messageService = new MessageService($messageRepository, $commentRepository);

        $message1 = new Message();
        $message1->setAuthor("me");
        $message1->setMessage("first");
        $messageRepository->addMessage($message1);

        $message2 = new Message();
        $message2->setAuthor("me");
        $message2->setMessage("second");
        $messageRepository->addMessage($message2);

        $messageService->removeMessage(1);
        $this->assertSame([2 => $message2], $messageService->getAllMessages());
    }
}
