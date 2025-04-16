<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;

/**
 * This class represents PluginVersionResponse
 *
 * @method string getFilename()
 * @method string getVersion()
 * @method \DateTime getCreatedAt()
 * @method string getMinCmsVersion()
 * @method string getMaxCmsVersion()
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class PluginVersionResponse extends ResponseEntity
{
    /** @var string $filename */
    protected $filename;

    /** @var string $version */
    protected $version;

    /** @var \DateTime $createdAt */
    protected $createdAt;

    /** @var string $minCmsVersion */
    protected $minCmsVersion;

    /** @var string $maxCmsVersion */
    protected $maxCmsVersion;

    /**
     * @param string $createdAt
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);

        return $this;
    }
}
