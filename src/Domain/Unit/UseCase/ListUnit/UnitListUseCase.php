<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\ListUnit;

use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Unit\Enitity\UnitInterface;
use Domain\Unit\Repository\UnitRepositoryInterface;

/**
 * Class UnitListUseCase
 *
 * @package Domain\Unit\UseCase\ListUnit
 */
class UnitListUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /**
     * @var UnitRepositoryInterface
     */
    private $unitRepository;

    /**
     * UnitListUseCase constructor.
     *
     * @param UnitRepositoryInterface $unitRepository
     */
    public function __construct(UnitRepositoryInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }


    public function execute()
    {
        $units = $this->unitRepository->findAll();
        $items = $this->fetchList($units);
        $this->unitListFetched($items);
    }

    /**
     * @param array $units
     * @return array
     */
    private function fetchList(array $units)
    {
        $list = [];
        /** @var UnitInterface $unit */
        foreach ($units as $unit) {
            $list[] = new UnitListItem(
                $unit->getId(),
                $unit->getName(),
                $unit->getShortcut()
            );
        }

        return $list;
    }

    /**
     * @param array $items
     */
    private function unitListFetched(array $items)
    {
        /** @var UnitListResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->unitListFetched(new UnitListResponse($items));
        }
    }

}