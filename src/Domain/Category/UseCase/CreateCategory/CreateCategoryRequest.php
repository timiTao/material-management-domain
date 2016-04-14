<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\CreateCategory;

use Domain\Category\Entity\CategoryInterface;

/**
 * Class CreateCategoryRequest
 *
 * @package Domain\Category\UseCase\CreateCategory
 */
class CreateCategoryRequest
{
    /** @var  string */
    private $name;

    /** @var  CategoryInterface */
    private $parent;

    /**
     * CreateCategoryRequest constructor.
     *
     * @param string $name
     * @param CategoryInterface $parent
     */
    public function __construct($name, CategoryInterface $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return CategoryInterface
     */
    public function getParent()
    {
        return $this->parent;
    }
}