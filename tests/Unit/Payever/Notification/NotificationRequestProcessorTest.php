<?php

namespace Payever\Tests\Unit\Payever\Notification;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Core\Lock\LockInterface;
use Payever\Sdk\Notification\NotificationHandlerInterface;
use Payever\Sdk\Notification\NotificationRequestProcessor;
use Psr\Log\NullLogger;

class NotificationRequestProcessorTest extends TestCase
{
    /** @var NotificationRequestProcessor */
    private $notificationRequestProcessor;

    /** @var NotificationHandlerInterface|MockObject */
    private $notificationHandler;

    /** @var LockInterface|MockObject */
    private $lock;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        $this->notificationHandler = $this->getMockForAbstractClass(
            'Payever\Sdk\Notification\NotificationHandlerInterface'
        );
        $this->lock = $this->getMockForAbstractClass(
            'Payever\Sdk\Core\Lock\LockInterface'
        );

        $this->notificationRequestProcessor = new NotificationRequestProcessor(
            $this->notificationHandler,
            $this->lock,
            new NullLogger()
        );
    }

    /**
     * @throws \Exception
     */
    public function testEmptyPayload()
    {
        $this->expectException(\RuntimeException::class);
        $this->notificationRequestProcessor->processNotification('');
    }

    /**
     * @throws \Exception
     */
    public function testInvalidPayload()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->notificationRequestProcessor->processNotification('{"type":"unknown"}');
    }

    public function testPositive()
    {
        $paymentId = 'stub_payment_id';
        $payload = json_encode(array(
            'notification_type' => 'payment.created',
            'notification_types_available' => array('payment.created'),
            'data' => array(
                'payment' => array(
                    'id' => $paymentId,
                ),
            ),
        ));

        $this->notificationHandler->expects($this->once())->method('handleNotification')->withAnyParameters();
        $this->lock->expects($this->once())
            ->method('acquireLock')
            ->with(
                $paymentId,
                NotificationRequestProcessor::NOTIFICATION_LOCK_SECONDS
            );
        $this->lock->expects($this->once())
            ->method('releaseLock')
            ->with($paymentId);

        $result = $this->notificationRequestProcessor->processNotification($payload);

        $this->assertInstanceOf(
            'Payever\Sdk\Notification\NotificationResult',
            $result
        );
    }
}
