<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Logger
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Logger;

use Payever\Sdk\Apm\ApmApiClient;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;

/**
 * This class represents ApmLogger
 * The ApmLoggerV3 class sends critical and error logs to the APM server
 */
class ApmLoggerV3 extends AbstractLogger
{
    /** @var LoggerInterface $logger */
    private $logger;

    /** @var ApmApiClient $apmApiClient */
    private $apmApiClient;

    /**
     * @param LoggerInterface $logger
     * @param ApmApiClient    $apmApiClient
     */
    public function __construct(LoggerInterface $logger, ApmApiClient $apmApiClient)
    {
        $this->logger = $logger;
        $this->apmApiClient = $apmApiClient;
    }

    /**
     * @param string|LogLevel $level
     * @param string          $message
     * @param array           $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        $this->logger->log($level, $message, $context);

        if ($level !== LogLevel::CRITICAL && $level !== LogLevel::ERROR) {
            return;
        }

        if (count($context) > 0) {
            $message .= ' ' . json_encode($context);
        }

        try {
            $this->apmApiClient->sendLog($message, $level);
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}
