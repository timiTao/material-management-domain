<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\CreateCategory;

use Domain\Category\CategoryFactoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\Category\Tree\TreeManager;
use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;

/**
 * Class CreateCategoryUseCase
 *
 * @package Domain\Category\UseCase\CreateCategory
 */
class CreateCategoryUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /** @var  CategoryRepositoryInterface */
    private $categoryRepository;

    /** @var  CategoryFactoryInterface */
    private $categoryFactory;

    /** @var  TreeManager */
    private $treeManager;

    /**
     * CreateCategoryUseCase constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryFactoryInterface $categoryFactory
     * @param TreeManager $treeManager
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CategoryFactoryInterface $categoryFactory,
        TreeManager $treeManager
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFactory = $categoryFactory;
        $this->treeManager = $treeManager;
    }

    /**
     * @param CreateCategoryRequest $request
     */
    public function execute(CreateCategoryRequest $request)
    {
        $category = $this->categoryFactory->create($request->getName());

        $this->categoryRepository->add($category);
        $this->treeManager->assignParent($category, $request->getParent());

        $this->categoryCreated();
    }

    private function categoryCreated()
    {
        /** @var CreateCategoryResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->categoryCreated();
        }
    }
}