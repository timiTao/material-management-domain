<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\CreateUnit;

use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;
use Domain\Unit\Enitity\UnitInterface;
use Domain\Unit\Repository\UnitRepositoryInterface;
use Domain\Unit\UnitFactoryInterface;

/**
 * Class CreateUnitUseCase
 *
 * @package Domain\Unit\UseCase\CreateUnit
 */
class CreateUnitUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /**
     * @var UnitRepositoryInterface
     */
    private $unitRepository;

    /**
     * @var UnitFactoryInterface
     */
    private $unitFactory;

    /**
     * CreateUnitUseCase constructor.
     *
     * @param UnitRepositoryInterface $unitRepository
     * @param UnitFactoryInterface $unitFactory
     */
    public function __construct(UnitRepositoryInterface $unitRepository, UnitFactoryInterface $unitFactory)
    {
        $this->unitRepository = $unitRepository;
        $this->unitFactory = $unitFactory;
    }

    /**
     * @param CreateUnitRequest $request
     */
    public function execute(CreateUnitRequest $request)
    {
        $unit = $this->unitFactory->create($request->getName(), $request->getShortcut());
        $this->unitRepository->add($unit);
        $this->unitCreated($unit);
    }

    /**
     * @param UnitInterface $unit
     */
    private function unitCreated(UnitInterface $unit)
    {
        /** @var CreateUnitResponderInterface $responder */
        foreach ($this->responders as $responder) {
            $responder->unitCreated(new CreateUnitResponse($unit->getName()));
        }
    }

}