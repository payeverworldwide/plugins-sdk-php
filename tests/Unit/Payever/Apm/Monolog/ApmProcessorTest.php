<?php

namespace Payever\Tests\Unit\Payever\Apm\Monolog;

use Monolog\Handler\NullHandler;
use Monolog\Logger;
use Payever\Sdk\Apm\ApmApiClient;
use Payever\Sdk\Apm\Monolog\ApmProcessor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApmProcessorTest extends TestCase
{
    /** @var ApmProcessor */
    private $apmProcessor;

    /** @var ApmApiClient|MockObject */
    private $apmApiClient;

    /** @var Logger */
    private $logger;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        if (version_compare(\Monolog\Logger::API, '3', '>=')) {
            $this->markTestSkipped('Monolog API v1/v2 is required.');
        }

        $this->apmApiClient = $this->getMockBuilder(ApmApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apmProcessor = new ApmProcessor(
            $this->apmApiClient
        );

        $apmApiClientReflection = new \ReflectionClass($this->apmProcessor);
        $apmApiClientProperty = $apmApiClientReflection->getProperty('apmApiClient');
        $apmApiClientProperty->setAccessible(true);
        $apmApiClientProperty->setValue($this->apmProcessor, $this->apmApiClient);
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        unset($this->apmProcessor);
    }

    /**
     * Test __invoke method.
     */
    public function testInvoke()
    {
        $this->logger = new Logger('test');
        $this->logger->pushProcessor($this->apmProcessor);
        $this->logger->pushHandler(new NullHandler());

        $this->apmApiClient
            ->expects($this->once())
            ->method('sendLog');
        $this->logger->critical('Test Monolog v' . Logger::API);
    }
}
