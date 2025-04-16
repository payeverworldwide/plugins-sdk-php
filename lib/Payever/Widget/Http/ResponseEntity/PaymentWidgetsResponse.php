<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;
use Payever\Sdk\Widget\Http\ResponseEntity\Result\PaymentWidgetsResult;

/**
 * This class represents CompanySearch ResponseInterface Entity
 */
class PaymentWidgetsResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        if (!is_array($data) || !isset($data['result'])) {
            $data = ['result' => $data];
        }

        return parent::load($data);
    }

    /**
     * {@inheritdoc}
     */
    public function setResult($result)
    {
        $this->result = [];
        foreach ($result as $item) {
            $this->result[] = new PaymentWidgetsResult($item);
        }
    }
}
