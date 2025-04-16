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

use Payever\Sdk\Apm\Authorization\ApmSecretService;
use Payever\Sdk\Apm\Logger\ApmLogger;
use Payever\Sdk\Apm\Logger\ApmLoggerV3;
use Payever\Sdk\Apm\Monolog\ApmProcessor;
use Payever\Sdk\Apm\Monolog\ApmProcessorV3;
use Payever\Sdk\Core\ClientConfiguration;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * This class represents ApmWrapper
 * The ApmWrapper class configures a logger with APM support
 */
class ApmWrapper
{
    /**
     * @param ClientConfiguration $clientConfiguration
     * @param ApmSecretService    $apmSecretService
     * @param LoggerInterface     $logger
     *
     * @return \Monolog\Logger|LoggerInterface
     *
     * @throws \Exception
     */
    public static function wrapLogger(
        ClientConfiguration $clientConfiguration,
        ApmSecretService $apmSecretService,
        LoggerInterface $logger = null
    ) {
        if (is_a($logger, ApmLogger::class) || is_a($logger, ApmLoggerV3::class)) {
            return $logger;
        }

        if (is_null($logger)) {
            $logger = new NullLogger();
        }

        $apmApiClient = new ApmApiClient($clientConfiguration);
        $apmApiClient->setApmSecretService($apmSecretService);

        // Configure Processor for Apm data collection
        if (is_a($logger, '\Monolog\Logger')) {
            /** @var \Monolog\Logger $logger */
            $processor = self::isApiMonologV3() ? new ApmProcessorV3($apmApiClient) : new ApmProcessor($apmApiClient);
            if (!in_array($processor, $logger->getProcessors())) {
                $logger->pushProcessor($processor);
            }

            return $logger;
        }

        $isV3 = version_compare(phpversion(), '7.1.0', '>=');

        // Wrap logger
        return $isV3 ? new ApmLoggerV3($logger, $apmApiClient) : new ApmLogger($logger, $apmApiClient);
    }

    /**
     * Checks if the Monolog library version is API version 3 or above.
     *
     * @return bool Returns true if the Monolog library version is API version 3 or above, false otherwise.
     */
    private static function isApiMonologV3()
    {
        return version_compare(\Monolog\Logger::API, '3', '>=');
    }
}
