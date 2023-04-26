<?php

/**
 * PHP version 5.4 and 8.1
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Igor.Siaryi <igor.siary@gmail.com>
 * @copyright 2017-2023 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\Sdk\Plugins\Http\ResponseEntity;

use Payever\Sdk\Core\Http\ResponseEntity;

/**
 * This class represents White Label plugin Entity
 *
 * @method string                           getCode()
 * @method string                           getNameEn()
 * @method string                           getNameDe()
 * @method string                           getShortDescriptionEn()
 * @method string                           getShortDescriptionDe()
 * @method string                           getDescriptionEn()
 * @method string                           getDescriptionDe()
 * @method array                            getSupportedMethods()
 * @method array                            getCountries()
 * @method array                            getCurrencies()
 * @method self                             setCode(string $code)
 * @method self                             setNameEn(string $nameEn)
 * @method self                             setNameDe(string $nameDe)
 * @method self                             setShortDescriptionEn(string $shortDescriptionEn)
 * @method self                             setShortDescriptionDe(string $shortDescriptionDe)
 * @method self                             setDescriptionEn(string $descriptionEn)
 * @method self                             setDescriptionDe(string $descriptionDe)
 * @method self                             setSupportedMethods(array $supportedMethods)
 * @method self                             setCountries(array $countries)
 * @method self                             setCurrencies(array $currencies)
 *
 */
class WhiteLabelPluginResponseEntity extends ResponseEntity
{
    /** @var string $code */
    protected $code;

    /** @var string $name_en */
    protected $nameEn;

    /** @var string $name_de */
    protected $nameDe;

    /** @var string $shortDescriptionEn */
    protected $shortDescriptionEn;

    /** @var string $shortDescriptionDe */
    protected $shortDescriptionDe;

    /** @var string $descriptionEn */
    protected $descriptionEn;

    /** @var string $descriptionDe */
    protected $descriptionDe;

    /** @var array $supportedMethods */
    protected $supportedMethods = [];

    /** @var array $countries */
    protected $countries = [];

    /** @var array $currencies */
    protected $currencies = [];
}
