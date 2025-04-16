<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Monolog
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Monolog;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Payever\Sdk\Apm\ApmApiClient;
use Psr\Log\LogLevel;

/**
 * This class represents ApmProcessor
 * The ApmProcessor class sends critical and error logs to the APM server when processing log records
 */
class ApmProcessor implements ProcessorInterface
{
    /** @var ApmApiClient $apmApiClient */
    private $apmApiClient;

    /**
     * @param ApmApiClient $apmApiClient
     */
    public function __construct(ApmApiClient $apmApiClient)
    {
        $this->apmApiClient = $apmApiClient;
    }

    /**
     * Apm processor callback.
     *
     * @param array|LogRecord $record
     *
     * @return array The processed record
     */
    public function __invoke(array $record)
    {
        $message = $record['message'];
        $logLevel = strtolower($record['level_name']);
        if ($logLevel !== LogLevel::CRITICAL && $logLevel !== LogLevel::ERROR) {
            return $record;
        }

        if ($record['context']) {
            $message .= ' ' . json_encode($record['context']);
        }

        try {
            $this->apmApiClient->sendLog($message, $logLevel);
        } catch (\Exception $exception) {
            // Silence is golden
        }

        return $record;
    }
}
