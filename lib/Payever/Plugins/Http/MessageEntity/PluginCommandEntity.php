<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;
use Payever\Sdk\Plugins\Enum\PluginCommandNameEnum;

/**
 * This class represents PluginCommandEntity
 *
 * @method string      getId()
 * @method string      getName()
 * @method string      getValue()
 * @method string|null getChannelType()
 * @method string|null getMinCmsVersion()
 * @method string|null getMaxCmsVersion()
 * @method array       getMetadata()
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class PluginCommandEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /**
     * @var string $name - {@see PluginCommandNameEnum}
     */
    protected $name;

    /** @var string $value */
    protected $value;

    /** @var string $channelType */
    protected $channelType;

    /** @var string $minCmsVersion */
    protected $minCmsVersion;

    /** @var string $maxCmsVersion */
    protected $maxCmsVersion;

    /**
     * Additional data with specific for each command fields
     *
     * @var array $metadata
     */
    protected $metadata = [];

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getMeta($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setMeta($key, $value)
    {
        $this->metadata[$key] = $value;

        return $this;
    }
}
