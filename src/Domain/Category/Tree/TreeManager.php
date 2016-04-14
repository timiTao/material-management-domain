<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\Tree;

use Domain\Category\Entity\CategoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;

/**
 * Class TreeManager
 *
 * @package Domain\Category\Tree
 */
class TreeManager
{
    /** @var  CategoryRepositoryInterface */
    private $categoryRepository;

    /**
     * TreeManager constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryInterface $newChild
     * @param CategoryInterface $parent
     */
    public function assignParent(CategoryInterface $newChild, CategoryInterface $parent)
    {
        $oldParent = $this->categoryRepository->getParent($newChild);

        if (!is_null($oldParent)) {
            $oldParent->removeChild($newChild);
            $this->categoryRepository->update($oldParent);

        }
        $parent->addChild($newChild);
        $this->categoryRepository->update($parent);
    }

}