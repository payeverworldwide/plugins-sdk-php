<?php

namespace Payever\Tests\Unit\Payever\WhiteLabel;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\WhiteLabel\WhiteLabelPluginsApiClient;

class WhiteLabelPluginsApiClientTest extends TestCase
{
    /**
     * @var (CurlClient&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClientMock;

    /**
     * @var WhiteLabelPluginsApiClient
     */
    private $whiteLabelPluginsApiClient;

    protected function setUp(): void
    {
        $this->httpClientMock = $this->getMockBuilder(CurlClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->whiteLabelPluginsApiClient = new WhiteLabelPluginsApiClient();
        $this->whiteLabelPluginsApiClient->setHttpClient($this->httpClientMock);
    }

    public function testGetWidgets()
    {
        $this->httpClientMock->expects($this->once())
            ->method('execute')
            ->willReturn(
                $this->getMockBuilder(Response::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $result = $this->whiteLabelPluginsApiClient->getWhiteLabelPlugin('code', 'shopware');
        $this->assertNotEmpty($result);
    }
}
