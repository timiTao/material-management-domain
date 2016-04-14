<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\EditUnit;

use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Unit\Enitity\UnitInterface;
use Domain\Unit\Repository\UnitRepositoryInterface;

/**
 * Class EditUnitUseCase
 *
 * @package Domain\Unit\UseCase\EditUnit
 */
class EditUnitUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;
    /**
     * @var UnitRepositoryInterface
     */
    private $unitRepository;

    /**
     * EditUnitUseCase constructor.
     *
     * @param UnitRepositoryInterface $unitRepository
     */
    public function __construct(UnitRepositoryInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * @param EditUnitRequest $request
     */
    public function execute(EditUnitRequest $request)
    {
        $unit = $this->unitRepository->findById($request->getUnitId());
        if (is_null($unit)) {
            $this->unitNotFound();

            return;
        }

        $unit->compose($request->getName(), $request->getShortcut());
        $this->unitRepository->update($unit);

        $this->unitUpdated($unit);
    }

    /**
     * @param UnitInterface $unit
     */
    private function unitUpdated(UnitInterface $unit)
    {
        /** @var EditUnitResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->unitUpdated(new EditUnitResponse($unit->getName()));
        }
    }

    private function unitNotFound()
    {
        /** @var EditUnitResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->unitNotFound();
        }
    }
}