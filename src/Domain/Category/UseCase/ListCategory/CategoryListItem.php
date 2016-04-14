<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\ListCategory;

/**
 * Class CategoryListItem
 *
 * @package Domain\Category\UseCase\ListCategory
 */
class CategoryListItem
{
    /** @var integer */
    private $id;

    /** @var  string */
    private $name;

    /**
     * CategoryListItem constructor.
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
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
}