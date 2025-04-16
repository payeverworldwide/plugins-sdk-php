<?php

namespace Payever\Tests\Unit\Payever\Apm;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Apm\ApmApiClient;
use Payever\Sdk\Apm\ApmWrapper;
use Payever\Sdk\Apm\Authorization\ApmSecretService;
use Payever\Sdk\Apm\Logger\ApmLoggerV3;
use Payever\Sdk\Apm\Monolog\ApmProcessor;
use Payever\Sdk\Core\ClientConfiguration;
use Psr\Log\NullLogger;

class ApmWrapperTest extends TestCase
{
    public function testApmLog()
    {
        $clientConfiguration = $this->getMockBuilder(ClientConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apmSecretService = $this->getMockBuilder(ApmSecretService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $nullLogger = new NullLogger();
        $apmLogger = ApmWrapper::wrapLogger($clientConfiguration, $apmSecretService, $nullLogger);
        $this->assertInstanceOf(ApmLoggerV3::class, $apmLogger);
    }

    public function testApmMonolog()
    {
        $clientConfiguration = $this->getMockBuilder(ClientConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apmSecretService = $this->getMockBuilder(ApmSecretService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $monolog = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $monolog->expects($this->once())
            ->method('getProcessors')
            ->willReturn([]);

        $monolog->expects($this->once())
            ->method('pushProcessor');

        $apmLogger = ApmWrapper::wrapLogger($clientConfiguration, $apmSecretService, $monolog);
        $this->assertInstanceOf(Logger::class, $apmLogger);
    }

    public function testApmMonologAlreadyExists()
    {
        $clientConfiguration = $this->getMockBuilder(ClientConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apmSecretService = $this->getMockBuilder(ApmSecretService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apmApiClient = new ApmApiClient($clientConfiguration);
        $apmApiClient->setApmSecretService($apmSecretService);

        $monolog = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $monolog->expects($this->once())
            ->method('getProcessors')
            ->willReturn([
                new ApmProcessor($apmApiClient)
            ]);

        $monolog->expects($this->never())->method('pushProcessor');

        $apmLogger = ApmWrapper::wrapLogger($clientConfiguration, $apmSecretService, $monolog);
        $this->assertInstanceOf(Logger::class, $apmLogger);
    }
}
