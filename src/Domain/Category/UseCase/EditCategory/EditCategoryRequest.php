<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\EditCategory;

/**
 * Class EditCategoryRequest
 *
 * @package Domain\Category\UseCase\EditCategory
 */
class EditCategoryRequest
{
    /** @var integer */
    private $categoryId;

    /** @var  string */
    private $name;

    /**
     * EditCategoryRequest constructor.
     *
     * @param int $categoryId
     * @param string $name
     */
    public function __construct($categoryId, $name)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}