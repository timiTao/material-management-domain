<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\EditMaterial;

use Domain\Category\Entity\CategoryInterface;
use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Common\UseCase\ResponderInterface;
use Domain\Material\Repository\MaterialRepositoryInterface;

/**
 * Class EditMaterialUseCase
 *
 * @package Domain\Material\UseCase\EditMaterial
 */
class EditMaterialUseCase implements ResponderInterface
{
    use ResponderAwareTrait;

    /** @var  MaterialRepositoryInterface */
    private $materialRepository;

    /**
     * EditMaterialUseCase constructor.
     *
     * @param MaterialRepositoryInterface $materialRepository
     */
    public function __construct(MaterialRepositoryInterface $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    /**
     * @param EditMaterialRequest $request
     */
    public function execute(EditMaterialRequest $request)
    {
        $material = $this->materialRepository->findById($request->getMaterialId());

        $category = $request->getCategory();
        if (count($category->getChildren())) {
            $this->callWarningLimitationAssignOnlyToLeaf($category);

            return;
        }


        $material->compose($request->getNewName(), $request->getNewCode());
        $material->setCategory($category);
        $material->setUnit($request->getUnit());

        $this->materialRepository->update($material);
    }

    /**
     * @param CategoryInterface $category
     */
    private function callWarningLimitationAssignOnlyToLeaf(CategoryInterface $category)
    {
        /** @var EditMaterialResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->callWarningLimitationAssignOnlyToLeaf($category);
        }
    }
}