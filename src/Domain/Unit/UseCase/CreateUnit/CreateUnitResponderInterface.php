<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\CreateUnit;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface CreateUnitResponderInterface
 *
 * @package Domain\Unit\UseCase\CreateUnit
 */
interface CreateUnitResponderInterface extends ResponderInterface
{
    /**
     * @param CreateUnitResponse $response
     * @return void
     */
    public function unitCreated(CreateUnitResponse $response);
}