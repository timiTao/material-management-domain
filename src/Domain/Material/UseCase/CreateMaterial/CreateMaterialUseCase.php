<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\CreateMaterial;

use Domain\Category\Entity\CategoryInterface;
use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Material\MaterialFactoryInterface;
use Domain\Material\Repository\MaterialRepositoryInterface;

/**
 * Class CreateMaterialUseCase
 *
 * @package Domain\Material\UseCase\CreateMaterial
 */
class CreateMaterialUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /** @var  MaterialRepositoryInterface */
    private $materialRepository;

    /** @var  MaterialFactoryInterface */
    private $materialFactory;

    /**
     * CreateMaterialUseCase constructor.
     *
     * @param MaterialRepositoryInterface $materialRepository
     * @param MaterialFactoryInterface $materialFactory
     */
    public function __construct(
        MaterialRepositoryInterface $materialRepository,
        MaterialFactoryInterface $materialFactory
    ) {
        $this->materialRepository = $materialRepository;
        $this->materialFactory = $materialFactory;
    }

    /**
     * @param CreateMaterialRequest $request
     */
    public function execute(CreateMaterialRequest $request)
    {
        $category = $request->getCategory();
        if (count($category->getChildren())) {
            $this->callWarningLimitationAssignOnlyToLeaf($category);

            return;
        }

        $material = $this->materialFactory->create(
            $request->getName(),
            $request->getCode(),
            $request->getCategory(),
            $request->getUnit()
        );
        $this->materialRepository->add($material);
    }

    /**
     * @param CategoryInterface $category
     */
    private function callWarningLimitationAssignOnlyToLeaf(CategoryInterface $category)
    {
        /** @var CreateMaterialResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->callWarningLimitationAssignOnlyToLeaf($category);
        }
    }
}