<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\EditCategory;

use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;

/**
 * Class EditCategoryUseCase
 *
 * @package Domain\Category\UseCase\EditCategory
 */
class EditCategoryUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    /**
     * EditCategoryUseCase constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param EditCategoryRequest $request
     */
    public function execute(EditCategoryRequest $request)
    {
        $category = $this->categoryRepository->findById($request->getCategoryId());
        $category->compose($request->getName());

        $this->categoryRepository->update($category);

        $this->categoryUpdated();
    }

    private function categoryUpdated()
    {
        /** @var EditCategoryResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->categoryUpdated();
        }
    }

}