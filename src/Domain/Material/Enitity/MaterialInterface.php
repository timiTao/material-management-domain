<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\Enitity;

use Domain\Category\Entity\CategoryInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Interface MaterialInterface
 *
 * @package Domain\Material\Enitity
 */
interface MaterialInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getCode();

    /**
     * @return UnitInterface
     */
    public function getUnit();

    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param string $name
     * @param string $code
     * @return void
     */
    public function compose($name, $code);

    /**
     * @param UnitInterface|null $unit
     * @return void
     */
    public function setUnit(UnitInterface $unit = null);

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function setCategory(CategoryInterface $category);
}