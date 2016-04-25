<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\CategoryStructure\Structure\Tree;

use Domain\Category\Entity\CategoryInterface;
use Domain\CategoryStructure\Repository\CategoryTreeRepositoryInterface;

/**
 * Class TreeManager
 *
 * @package Domain\Category\Structure\Tree
 */
class TreeManager
{
    /** @var  CategoryTreeRepositoryInterface */
    private $categoryTreeRepository;

    /**
     * TreeManager constructor.
     *
     * @param CategoryTreeRepositoryInterface $categoryTreeRepository
     */
    public function __construct(CategoryTreeRepositoryInterface $categoryTreeRepository)
    {
        $this->categoryTreeRepository = $categoryTreeRepository;
    }

    /**
     * @param CategoryInterface $parent
     * @param CategoryInterface $newChild
     */
    public function assignParent(CategoryInterface $parent, CategoryInterface $newChild)
    {
//        $oldParent = $this->categoryTreeRepository->getParent($newChild);
//
//        if (!is_null($oldParent)) {
//            $oldParent->removeChild($newChild);
//            $this->categoryTreeRepository->update($oldParent);
//
//        }
//        $parent->addChild($newChild);
//        $this->categoryTreeRepository->update($parent);
    }
}
