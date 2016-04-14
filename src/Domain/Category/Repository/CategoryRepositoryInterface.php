<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\Repository;

use Domain\Category\Entity\CategoryInterface;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package Domain\Category\Repository
 */
interface CategoryRepositoryInterface
{

    /**
     * @return CategoryInterface[]
     */
    public function findAll();

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function add(CategoryInterface $category);

    /**
     * @param $getCategoryId
     * @return CategoryInterface
     */
    public function findById($getCategoryId);

    /**
     * @return CategoryInterface
     */
    public function findRootCategory();

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function update(CategoryInterface $category);

    /**
     * @param CategoryInterface $category
     * @return CategoryInterface
     */
    public function getParent(CategoryInterface $category);
}