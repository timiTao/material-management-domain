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

/**
 * Class CategoryRepository
 *
 * @package Behat\Domain\Category
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /** @var  CategoryInterface[] */
    private $list;

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
     * @return CategoryInterface
     */
    public function findRootCategory()
    {
        foreach ($this->list as $item) {
            if ($item->isRoot()) {
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

    /**
     * @param CategoryInterface $category
     * @return CategoryInterface
     */
    public function getParent(CategoryInterface $category)
    {
        /** @var CategoryInterface $item */
        foreach ($this->list as $item) {
            if ($item->hasChild($category)) {
                return $item;
            }
        }
    }
}