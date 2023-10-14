<?php

namespace App\Domains\Cart\Enums;

use Spatie\Enum\Enum;


/**
 * @method static self pending()
 * @method static self checkedOut()
 * @method static self failed()
 * @method static self paid()
 */
class CartStatus extends Enum
{

}
