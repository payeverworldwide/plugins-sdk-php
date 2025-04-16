<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Service
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata\Service;

use Payever\Sdk\Apm\Enum\ApmAgent;
use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents AgentEntity
 *
 * @method string getName()
 * @method string getVersion()
 * @method $this  setName(string $name)
 * @method $this  setVersion(string $version)
 */
class AgentEntity extends ApmMessageEntity
{
    /** @var string $name */
    protected $name = ApmAgent::NAME;

    /** @var string $version */
    protected $version = ApmAgent::VERSION;
}
