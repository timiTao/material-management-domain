<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\MoveCategory;

use Domain\Category\Entity\CategoryInterface;

/**
 * Class MoveCategoryRequest
 *
 * @package Domain\Category\UseCase\MoveCategory
 */
class MoveCategoryRequest
{
    /** @var  CategoryInterface */
    private $child;

    /** @var  CategoryInterface */
    private $newParent;

    /**
     * MoveCategoryRequest constructor.
     *
     * @param CategoryInterface $child
     * @param CategoryInterface $newParent
     */
    public function __construct(CategoryInterface $child, CategoryInterface $newParent)
    {
        $this->child = $child;
        $this->newParent = $newParent;
    }

    /**
     * @return CategoryInterface
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @return CategoryInterface
     */
    public function getNewParent()
    {
        return $this->newParent;
    }
}