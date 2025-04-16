<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Apm
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm;

use Exception;
use Payever\Sdk\Apm\Authorization\ApmSecretService;
use Payever\Sdk\Apm\Enum\ApmAgent;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Error;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Error\StacktraceEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Transaction;
use Payever\Sdk\Apm\Http\RequestEntity\ApmEventsRequest;
use Payever\Sdk\Apm\Http\RequestEntity\ApmSecretRequest;
use Payever\Sdk\Apm\Http\ResponseEntity\AmpSecretResponse;
use Payever\Sdk\Core\Base\ClientConfigurationInterface;
use Payever\Sdk\Core\Base\HttpClientInterface;
use Payever\Sdk\Core\Base\OauthTokenInterface;
use Payever\Sdk\Core\Base\RequestInterface;
use Payever\Sdk\Core\CommonApiClient;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Request;
use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Core\Http\Response;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\NullLogger;

/**
 * This class represents Apm Api Connector
 * The ApmApiClient class sends logs and events to an APM server for monitoring
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ApmApiClient extends CommonApiClient
{
    const LIVE_SERVER = 'https://6899662bbf784bef97fab0d31854d2b1.apm.westeurope.azure.elastic-cloud.com:443';
    const SANDBOX_SERVER = 'https://dcf931daf8b94ce8aaa202112daad769.apm.westeurope.azure.elastic-cloud.com:443';
    const SUB_URL_AMP_DATA = 'api/plugin/apm-data';

    /** @var string|null $apmSecret */
    private $apmSecret;

    /** @var null|ApmSecretService $apmSecretService */
    private $apmSecretService;

    /**
     * Send events to the server
     *
     * @param string $message
     * @param string $logLevel
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendLog($message, $logLevel)
    {
        $apmSecret = $this->getApmSecret();
        if (empty($apmSecret)) {
            return false;
        }

        $apmRequestEntity = new ApmEventsRequest();

        //build and set metadata event
        $metadata = $this->buildMetadata();
        $apmRequestEntity->setMetaEvent($metadata);

        //build and set transaction event
        $transaction = $this->buildTransaction($logLevel);
        $apmRequestEntity->setTransactionEvent($transaction);

        //build and set error event
        $errorEvent = $this->buildErrorEvent($message);
        $errorEvent
            ->setParentId($transaction->getId())
            ->setTraceId($transaction->getTraceId())
            ->setTransactionId($transaction->getId());

        $apmRequestEntity->setErrorEvent($errorEvent);

        $builder = new RequestBuilder($this->getIntakeEndpoint(), Request::METHOD_POST);
        $request = $builder
            ->setRequestEntity($apmRequestEntity)
            ->addHeader('User-Agent', ApmAgent::NAME)
            ->addRawHeader(sprintf("Authorization: Bearer %s", $apmSecret))
            ->addHeader('Content-Type', 'application/x-ndjson')
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * Get Http client
     *
     * @return CurlClient
     */
    public function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new CurlClient();
        }

        if ($this->httpClient instanceof LoggerAwareInterface) {
            $this->httpClient->setLogger(new NullLogger());
        }

        return $this->httpClient;
    }

    /**
     * Set http client
     *
     * @param HttpClientInterface $httpClient
     *
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    public function getApmSecret()
    {
        $this->apmSecret = $this->apmSecret ?: $this->getApmSecretService()->get();
        if (null === $this->apmSecret) {
            //get apm secret from the server
            $this->apmSecret = $this->obtainApmSecretRequest()->getResponseEntity()->getApmSecret();
            //save secret
            $this->getApmSecretService()->save($this->apmSecret);
        }

        return $this->apmSecret;
    }

    /**
     * @return ApmSecretService
     */
    public function getApmSecretService()
    {
        return $this->apmSecretService ?: new ApmSecretService();
    }

    /**
     * @param ApmSecretService $apmSecretService
     *
     * @return $this
     */
    public function setApmSecretService(ApmSecretService $apmSecretService)
    {
        $this->apmSecretService = $apmSecretService;

        return $this;
    }

    /**
     * @return string
     */
    protected function getApmAuthenticationURL()
    {
        return $this->getBaseEntrypoint() . self::SUB_URL_AMP_DATA;
    }

    /**
     * Generate throwable object for getting code trace for message
     *
     * @param string $message
     *
     * @return \Exception
     */
    protected function mockException($message)
    {
        try {
            throw new Exception($message);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Send events to the server
     *
     * @param RequestInterface $request
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function executeRequest($request, $scope = OauthTokenInterface::SCOPE_PAYMENT_ACTIONS)
    {
        try {
            $response = $this->getHttpClient()->execute($request);

            return $response->isSuccessful();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @return Response
     *
     * @throws \Exception
     */
    protected function obtainApmSecretRequest()
    {
        $this->configuration->assertLoaded();

        $requestEntity = new ApmSecretRequest();
        $requestEntity
            ->setClientId($this->configuration->getClientId())
            ->setClientSecret($this->configuration->getClientSecret());

        $request = RequestBuilder::post($this->getApmAuthenticationURL())
            ->setRequestEntity($requestEntity)
            ->contentTypeIsJson()
            ->setResponseEntity(new AmpSecretResponse())
            ->build();

        return $this->getHttpClient()->execute($request);
    }

    /**
     * Get api endpoint
     *
     * @return string
     */
    private function getIntakeEndpoint()
    {
        $server = self::SANDBOX_SERVER;
        if ($this->configuration->getApiMode() == ClientConfigurationInterface::API_MODE_LIVE) {
            $server = self::LIVE_SERVER;
        }

        return sprintf(
            '%s/intake/v2/events',
            $server
        );
    }

    /**
     * Metadata prototype
     *
     * @return Metadata
     */
    private function buildMetadata()
    {
        $metadata = new Metadata();

        $metadata->getService()
            ->setName($this->configuration->getChannelSet())
            ->setVersion($this->configuration->getPluginVersion())
            ->setEnvironment($this->configuration->getApiMode());

        $metadata->getSystem()->setHostname($this->configuration->getBusinessUuid());

        return $metadata;
    }

    /**
     * Transaction prototype
     *
     * @param string $name
     *
     * @return Transaction
     */
    private function buildTransaction($name)
    {
        $transaction = new Transaction();
        $transaction
            ->setId($this->generateEventId())
            ->setTimestamp($this->getTimestamp())
            ->setName($name);

        return $transaction;
    }

    /**
     * Error prototype
     *
     * @param string $message
     *
     * @return Error
     */
    private function buildErrorEvent($message)
    {
        $thrown = $this->mockException($message);
        $lineNumber = $thrown->getLine();
        $filePath = $thrown->getFile();

        $event = new Error();
        $event
            ->setId($this->generateEventId())
            ->setTimestamp($this->getTimestamp())
            ->setCulprit(sprintf('%s:%d', $filePath, $lineNumber));

        $eventException = $event->getException();
        $eventException
            ->setMessage($thrown->getMessage())
            ->setType(get_class($thrown))
            ->setCode($thrown->getCode());

        foreach ($thrown->getTrace() as $trace) {
            $stacktraceEntity = $eventException->getStacktraceEntity();
            $this->populateStacktraceEntity($stacktraceEntity, $trace);
            $eventException->addStacktrace($stacktraceEntity);
        }

        return $event;
    }

    /**
     * @param StacktraceEntity $stacktraceEntity
     * @param array            $traceLine
     *
     * @return void
     */
    private function populateStacktraceEntity($stacktraceEntity, $traceLine)
    {
        $stacktraceEntity->setFunction(!empty($traceLine['function']) ? $traceLine['function'] : '(closure)');

        $stacktraceEntity->setLineno(0);
        if (!empty($traceLine['line'])) {
            $stacktraceEntity->setLineno($traceLine['line']);
        }

        $stacktraceEntity->setFilename('(anonymous)');
        if (!empty($traceLine['file'])) {
            $stacktraceEntity
                ->setFilename(basename($traceLine['file']))
                ->setAbsPath($traceLine['file']);
        }

        if (!empty($traceLine['class'])) {
            $stacktraceEntity->setModule($traceLine['class']);
        }

        if (!empty($traceLine['type'])) {
            $stacktraceEntity->setType($traceLine['type']);
        }
    }

    /**
     * Generate unique event id
     *
     * @return string
     */
    private function generateEventId()
    {
        return uniqid(microtime(true));
    }

    /**
     * Generate event timestamp.
     * Timestamp holds the recorded time of the event, UTC based and formatted as microseconds since Unix epoch
     *
     * @return int
     */
    private function getTimestamp()
    {
        return (int)sprintf(
            '%.0f',
            floor(microtime(true) * ApmAgent::MICROTIME_MULTIPLIER)
        );
    }
}
