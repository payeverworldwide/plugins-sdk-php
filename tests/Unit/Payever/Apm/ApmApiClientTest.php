<?php

namespace Payever\Tests\Unit\Payever\Apm;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Apm\ApmApiClient;
use Payever\Sdk\Apm\Authorization\ApmSecretService;
use Payever\Sdk\Core\ClientConfiguration;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Response;

class ApmApiClientTest extends TestCase
{
    /**
     * @var (ClientConfiguration&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $clientConfiguration;

    /**
     * @var ApmApiClient
     */
    private $apmApiClient;

    /**
     * @var (CurlClient&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClientMock;

    /**
     * @var (ApmSecretService&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $apmSecretService;

    protected function setUp(): void
    {
        $this->clientConfiguration = $this->getMockBuilder(ClientConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpClientMock = $this->getMockBuilder(CurlClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apmSecretService = $this->getMockBuilder(ApmSecretService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apmApiClient = new ApmApiClient($this->clientConfiguration);
        $this->apmApiClient->setHttpClient($this->httpClientMock);
        $this->apmApiClient->setApmSecretService($this->apmSecretService);
    }

    public function testSendLog()
    {
        $this->apmSecretService->expects($this->once())
            ->method('get')
            ->willReturn('test');

        $this->httpClientMock->expects($this->once())
            ->method('execute')
            ->willReturn(
                $response = $this->getMockBuilder(Response::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $response->expects($this->once())
            ->method('isSuccessful')
            ->willReturn(true);

        $result = $this->apmApiClient->sendLog('log message', 'info');
        $this->assertTrue($result);
    }
}
