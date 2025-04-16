<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;
use Payever\Sdk\Core\Base\MessageEntityInterface;

/**
 * This class represents ApmMessageEntity
 */
class ApmMessageEntity extends MessageEntity
{
    /**
     * Creates $className instance
     *
     * @param string $className
     * @param $propertyValue
     *
     * @return MessageEntityInterface|mixed|null
     */
    protected function getClassInstance($className, $propertyValue)
    {
        if (!$propertyValue) {
            return null;
        }

        if ($propertyValue instanceof $className) {
            return $propertyValue;
        }

        if (is_string($propertyValue)) {
            $propertyValue = json_decode($propertyValue);
        }

        if (!is_array($propertyValue) && !is_object($propertyValue)) {
            return $this;
        }

        return new $className($propertyValue);
    }
}
