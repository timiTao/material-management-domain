<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\CreateMaterial;

use Domain\Category\Entity\CategoryInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Class CreateMaterialRequest
 *
 * @package Domain\Material\UseCase\CreateMaterial
 */
class CreateMaterialRequest
{
    /** @var  string */
    private $name;

    /** @var  string */
    private $code;

    /** @var  UnitInterface */
    private $unit;

    /** @var  CategoryInterface */
    private $category;

    /**
     * CreateMaterialRequest constructor.
     *
     * @param string $name
     * @param string $code
     * @param UnitInterface $unit
     * @param CategoryInterface $category
     */
    public function __construct($name, $code, CategoryInterface $category, UnitInterface $unit = null)
    {
        $this->name = $name;
        $this->code = $code;
        $this->category = $category;
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return UnitInterface|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }
}