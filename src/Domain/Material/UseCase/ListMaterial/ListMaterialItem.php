<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\ListMaterial;

/**
 * Class ListMaterialItem
 *
 * @package Domain\Material\UseCase\ListMaterial
 */
class ListMaterialItem
{
    /** @var  int */
    public $id;

    /** @var  string */
    public $name;

    /** @var  string */
    public $code;

    /** @var  string */
    public $unitName;

    /** @var  string */
    public $categoryName;

    /**
     * ListMaterialItem constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $code
     * @param string $unitName
     * @param string $categoryName
     */
    public function __construct($id, $name, $code, $unitName, $categoryName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->unitName = $unitName;
        $this->categoryName = $categoryName;
    }
}