<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\ListUnit;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface UnitListResponderInterface
 *
 * @package Domain\Unit\UseCase\ListUnit
 */
interface UnitListResponderInterface extends ResponderInterface
{
    /**
     * @param UnitListResponse $response
     */
    public function unitListFetched(UnitListResponse $response);
}