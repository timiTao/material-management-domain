<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\ListMaterial;

use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Common\UseCase\ResponderInterface;
use Domain\Material\Enitity\MaterialInterface;
use Domain\Material\Repository\MaterialRepositoryInterface;

/**
 * Class ListMaterialsUseCase
 *
 * @package Domain\Material\UseCase\ListMaterial
 */
class ListMaterialUseCase implements ResponderInterface
{
    use ResponderAwareTrait;

    /** @var  MaterialRepositoryInterface */
    private $materialsRepository;

    /**
     * ListMaterialsUseCase constructor.
     *
     * @param MaterialRepositoryInterface $materialsRepository
     */
    public function __construct(MaterialRepositoryInterface $materialsRepository)
    {
        $this->materialsRepository = $materialsRepository;
    }

    public function execute()
    {
        $materials = $this->materialsRepository->findAll();
        $items = $this->fetchItems($materials);
        $this->listFetched($items);
    }

    /**
     * @param $materials
     *
     * @return ListMaterialItem[]
     */
    private function fetchItems($materials)
    {
        $list = [];
        /** @var MaterialInterface $material */
        foreach ($materials as $material) {
            $unitName = null;
            $unit = $material->getUnit();
            if (!is_null($unit)) {
                $unitName = $unit->getName();
            }

            $list[] = new ListMaterialItem(
                $material->getId(),
                $material->getName(),
                $material->getCode(),
                $unitName,
                $material->getCategory()->getName()
            );
        }

        return $list;
    }

    /**
     * @param array $items
     */
    private function listFetched(array $items)
    {
        /** @var ListMaterialResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->listFetched(new ListMaterialResponse($items));
        }
    }
}