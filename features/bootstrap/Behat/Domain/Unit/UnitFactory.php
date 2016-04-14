<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Unit;

use Domain\Unit\UnitFactoryInterface;

/**
 * Class UnitFactory
 */
class UnitFactory implements UnitFactoryInterface
{

    /**
     * @param string $name
     * @param string $shortcut
     * @return \Domain\Unit\Enitity\UnitInterface
     */
    public function create($name, $shortcut)
    {
        return new Unit($name, $shortcut);
    }
}