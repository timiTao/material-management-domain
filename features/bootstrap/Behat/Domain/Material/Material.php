<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Material;

use Domain\Category\Entity\CategoryInterface;
use Domain\Material\Enitity\MaterialInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Class Material
 *
 * @package Behat\Domain\Material
 */
class Material implements MaterialInterface
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
     * Material constructor.
     *
     * @param string $name
     * @param string $code
     * @param UnitInterface $unit
     * @param CategoryInterface $category
     */
    public function __construct($name, $code, CategoryInterface $category, UnitInterface $unit = null)
    {
        $this->id = md5(microtime());
        $this->name = $name;
        $this->code = $code;
        $this->unit = $unit;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return UnitInterface
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

    /**
     * @param string $name
     * @param string $code
     * @return void
     */
    public function compose($name, $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * @param UnitInterface $unit
     */
    public function setUnit(UnitInterface $unit = null)
    {
        $this->unit = $unit;
    }

    /**
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
    }


}