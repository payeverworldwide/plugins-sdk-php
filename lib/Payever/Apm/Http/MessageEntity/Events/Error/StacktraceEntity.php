<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Error
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Error;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents Stacktrace
 *
 * @method null|string getFunction()
 * @method null|string getLineno()
 * @method null|string getFilename()
 * @method null|string getModule()
 * @method null|string getType()
 * @method $this       setFunction(string $function)
 * @method $this       setLineno(string $lineno)
 * @method $this       setModule(string $module)
 * @method $this       setType(string $type)
 * @method $this       setFilename(string $filename)
 */
class StacktraceEntity extends ApmMessageEntity
{
    /** @var string $function */
    protected $function;

    /** @var string $lineno */
    protected $lineno;

    /** @var string $filename */
    protected $filename;

    /** @var string $absPath */
    protected $absPath;

    /** @var string $module */
    protected $module;

    /** @var string $type */
    protected $type;

    /**
     * @return string
     */
    public function getAbsPath()
    {
        return $this->absPath;
    }

    /**
     * @param $absPath
     *
     * @return $this
     */
    public function setAbsPath($absPath)
    {
        $this->absPath = $absPath;

        return $this;
    }
}
