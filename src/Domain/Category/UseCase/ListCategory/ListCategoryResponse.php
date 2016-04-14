<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\ListCategory;

/**
 * Class ListCategoryResponse
 *
 * @package Domain\Category\UseCase\ListCategory
 */
class ListCategoryResponse
{
    /**
     * @var CategoryListItem[]
     */
    public $items;

    /**
     * ListCategoryResponse constructor.
     *
     * @param CategoryListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}