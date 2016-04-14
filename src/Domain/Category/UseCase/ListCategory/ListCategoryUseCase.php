<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\ListCategory;

use Domain\Category\Entity\CategoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;

/**
 * Class ListCategoryUseCase
 *
 * @package Domain\Category\UseCase\ListCategory
 */
class ListCategoryUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /** @var  CategoryRepositoryInterface */
    private $categoryRepository;

    /**
     * ListCategoryUseCase constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     *
     */
    public function execute()
    {
        $categories = $this->categoryRepository->findAll();
        $items = $this->fetchCategoriesItems($categories);
        $this->listFetched($items);
    }

    /**
     * @param $categories
     * @return CategoryListItem[]
     */
    private function fetchCategoriesItems($categories)
    {
        $list = [];
        /** @var CategoryInterface $category */
        foreach ($categories as $category) {
            $list[] = new CategoryListItem($category->getId(), $category->getName());
        }

        return $list;
    }

    /**
     * @param $items
     */
    private function listFetched($items)
    {
        /** @var ListCategoryResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->listFetched(new ListCategoryResponse($items));
        }
    }
}