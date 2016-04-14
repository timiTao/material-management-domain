<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\EditUnit;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface EditUnitResponderInterface
 *
 * @package Domain\Unit\UseCase\EditUnit
 */
interface EditUnitResponderInterface extends ResponderInterface
{
    /**
     * @param EditUnitResponse $response
     * @return void
     */
    public function unitUpdated(EditUnitResponse $response);

    /**
     * @return void
     */
    public function unitNotFound();
}