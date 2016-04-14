<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material;

use Domain\Category\Entity\CategoryInterface;
use Domain\Material\Enitity\MaterialInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Interface MaterialFactoryInterface
 *
 * @package Domain\Material
 */
interface MaterialFactoryInterface
{
    /**
     * @param string $name
     * @param string $code
     * @param UnitInterface $unit
     * @param CategoryInterface $category
     * @return MaterialInterface
     */
    public function create($name, $code, CategoryInterface $category, UnitInterface $unit);
}