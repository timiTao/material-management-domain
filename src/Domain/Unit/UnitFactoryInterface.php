<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit;

use Domain\Unit\Enitity\UnitInterface;

/**
 * Interface UnitFactoryInterface
 *
 * @package Domain\Unit
 */
interface UnitFactoryInterface
{
    /**
     * @param string $name
     * @param string $shortcut
     * @return UnitInterface
     */
    public function create($name, $shortcut);
}