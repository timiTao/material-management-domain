<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Material;

use Behat\Domain\Unit\Unit;
use Domain\Category\Entity\CategoryInterface;
use Domain\Material\Enitity\MaterialInterface;
use Domain\Material\MaterialFactoryInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Class MaterialFactory
 *
 * @package Behat\Domain\Material
 */
class MaterialFactory implements MaterialFactoryInterface
{
    /**
     * @param string $name
     * @param string $code
     * @param UnitInterface $unit
     * @param CategoryInterface $category
     * @return MaterialInterface
     */
    public function create($name, $code, CategoryInterface $category, UnitInterface $unit = null)
    {
        return new Material($name, $code, $category, $unit);
    }
}