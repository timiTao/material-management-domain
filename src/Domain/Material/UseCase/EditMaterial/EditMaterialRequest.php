<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\EditMaterial;

use Domain\Category\Entity\CategoryInterface;
use Domain\Unit\Enitity\UnitInterface;

/**
 * Class EditMaterialRequest
 *
 * @package Domain\Material\UseCase\EditMaterial
 */
class EditMaterialRequest
{
    /** @var  int */
    private $materialId;

    /** @var  string */
    private $newName;

    /** @var  string */
    private $newCode;

    /** @var  CategoryInterface */
    private $category;

    /** @var  UnitInterface */
    private $unit;

    /**
     * EditMaterialRequest constructor.
     *
     * @param int $materialId
     * @param string $newName
     * @param string $newCode
     * @param CategoryInterface $category
     * @param UnitInterface $unit
     */
    public function __construct(
        $materialId,
        $newName,
        $newCode,
        CategoryInterface $category,
        UnitInterface $unit = null
    ) {
        $this->materialId = $materialId;
        $this->newName = $newName;
        $this->newCode = $newCode;
        $this->category = $category;
        $this->unit = $unit;
    }

    /**
     * @return int
     */
    public function getMaterialId()
    {
        return $this->materialId;
    }

    /**
     * @return string
     */
    public function getNewName()
    {
        return $this->newName;
    }

    /**
     * @return string
     */
    public function getNewCode()
    {
        return $this->newCode;
    }

    /**
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return UnitInterface|null
     */
    public function getUnit()
    {
        return $this->unit;
    }
}