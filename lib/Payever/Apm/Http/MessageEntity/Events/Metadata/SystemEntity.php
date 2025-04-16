<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Metadata
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents SystemEntity
 *
 * @method string getName()
 * @method string getArchitecture()
 * @method string getPlatform()
 * @method $this  setHostname(string $hostname)
 * @method $this  setArchitecture(string $architecture)
 * @method $this  setPlatform(string $platform)
 */
class SystemEntity extends ApmMessageEntity
{
    /** @var string $hostname */
    protected $hostname;

    /** @var string $architecture */
    protected $architecture;

    /** @var string $platform */
    protected $platform;

    /**
     * @param array|null $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['architecture'])) {
            $data['architecture'] = php_uname('m');
        }

        if (!isset($data['platform'])) {
            $data['platform'] = php_uname('s');
        }

        parent::__construct($data);
    }
}
