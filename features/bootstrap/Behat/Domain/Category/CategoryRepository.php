<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Category;

use Domain\Category\Entity\CategoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\CategoryStructure\Repository\CategoryTreeRepositoryInterface;

/**
 * Class CategoryRepository
 *
 * @package Behat\Domain\Category
 */
class CategoryRepository implements
    CategoryRepositoryInterface,
    CategoryTreeRepositoryInterface
{
    /** @var  CategoryInterface[] */
    private $list;

    /** @var  array */
    private $family;

    /**
     * CategoryRepository constructor.
     *
     * @param \Domain\Category\Entity\CategoryInterface[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
    }

    /**
     * @return CategoryInterface[]
     */
    public function findAll()
    {
        return $this->list;
    }

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function add(CategoryInterface $category)
    {
        $this->list[] = $category;
    }


    /**
     * @param int $id
     * @return CategoryInterface
     */
    public function findById($id)
    {
        foreach ($this->list as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
    }

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function update(CategoryInterface $category)
    {
        foreach ($this->list as $key => $item) {
            if ($item->getId() == $category->getId()) {
                $this->list[$key] = $category;
                break;
            }
        }
    }

    public function findRootCategory()
    {
        // TODO: Implement findRootCategory() method.
    }

    public function getParent(CategoryInterface $category)
    {
        // TODO: Implement getParent() method.
    }

    public function assignToParent(CategoryInterface $parent, CategoryInterface $child)
    {
        // TODO: Implement assignToParent() method.
    }

    public function markAsTreeRoot(CategoryInterface $category)
    {
        // TODO: Implement markAsTreeRoot() method.
    }
}