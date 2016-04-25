<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\CategoryStructure\Repository;

use Domain\Category\Entity\CategoryInterface;

/**
 * Interface CategoryTreeRepositoryInterface
 *
 * @package Domain\Category\Repository
 */
interface CategoryTreeRepositoryInterface
{
    /**
     * @return CategoryInterface
     */
    public function findRootCategory();

    /**
     * @param CategoryInterface $category
     * @return CategoryInterface
     */
    public function getParent(CategoryInterface $category);

    /**
     * @param CategoryInterface $parent
     * @param CategoryInterface $child
     */
    public function assignToParent(CategoryInterface $parent, CategoryInterface $child);

    /**
     * @param CategoryInterface $category
     *
     * @return void
     */
    public function markAsTreeRoot(CategoryInterface $category);
}
