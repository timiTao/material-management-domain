<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Domain\Unit\Repository\UnitRepositoryInterface;
use Domain\Unit\UnitFactoryInterface;
use Domain\Unit\UseCase\CreateUnit\CreateUnitRequest;
use Domain\Unit\UseCase\CreateUnit\CreateUnitResponderInterface;
use Domain\Unit\UseCase\CreateUnit\CreateUnitResponse;
use Domain\Unit\UseCase\CreateUnit\CreateUnitUseCase;
use Domain\Unit\UseCase\EditUnit\EditUnitRequest;
use Domain\Unit\UseCase\EditUnit\EditUnitResponderInterface;
use Domain\Unit\UseCase\EditUnit\EditUnitResponse;
use Domain\Unit\UseCase\EditUnit\EditUnitUseCase;
use Domain\Unit\UseCase\ListUnit\UnitListItem;
use Domain\Unit\UseCase\ListUnit\UnitListResponderInterface;
use Domain\Unit\UseCase\ListUnit\UnitListResponse;
use Domain\Unit\UseCase\ListUnit\UnitListUseCase;

/**
 * Class UnitFeatureContext
 *
 * @package Behat\Domain
 */
class UnitFeatureContext implements
    SnippetAcceptingContext,
    UnitListResponderInterface,
    CreateUnitResponderInterface,
    EditUnitResponderInterface
{

    /** @var  UnitListItem[] */
    private $unitsList;

    /** @var UnitListUseCase */
    private $unitListUseCase;

    /** @var CreateUnitUseCase */
    private $createUnitUseCase;

    /** @var  EditUnitUseCase */
    private $editUnitUseCase;

    /** @var UnitRepositoryInterface */
    private $unitRepository;

    /** @var UnitFactoryInterface */
    private $unitFactory;

    /**
     * UnitFeatureContext constructor.
     */
    public function __construct()
    {
        $this->unitsList = array();

        $this->unitRepository = new Unit\UnitRepository();
        $this->unitFactory = new Unit\UnitFactory();
        $this->unitListUseCase = new UnitListUseCase(
            $this->unitRepository
        );
        $this->createUnitUseCase = new CreateUnitUseCase(
            $this->unitRepository,
            $this->unitFactory
        );

        $this->editUnitUseCase = new EditUnitUseCase(
            $this->unitRepository
        );

        $this->unitListUseCase->addResponder($this);
        $this->createUnitUseCase->addResponder($this);
        $this->editUnitUseCase->addResponder($this);
    }


    /**
     * @Given there are such units:
     *
     * @param TableNode $table
     */
    public function thereAreSuchUnits(TableNode $table)
    {
        foreach ($table as $row) {
            $this->iCreateUnitWithShortcut($row['name'], $row['shortcut']);
        }
    }

    /**
     * @Given I listening units
     */
    public function iListeningUnits()
    {
        $this->unitListUseCase->execute();
    }

    /**
     * @Then I should see given units:
     *
     * @param TableNode $table
     * @throws Exception
     */
    public function iShouldSeeGivenUnits(TableNode $table)
    {
        foreach ($table as $row) {
            $found = array_filter(
                $this->unitsList,
                function (UnitListItem $unitListItem) use ($row) {
                    return $unitListItem->getName() == $row['name'] && $unitListItem->getShortcut() == $row['shortcut'];
                }
            );

            if (!$found) {
                throw new \Exception(sprintf('Unit %s is not found', $row['name']));
            }
        }
    }

    /**
     * @Given I create unit :arg1 with shortcut :arg2
     *
     * @param $name
     * @param $shortcut
     */
    public function iCreateUnitWithShortcut($name, $shortcut)
    {
        $this->createUnitUseCase->execute(new CreateUnitRequest($name, $shortcut));
    }

    /**
     * @Then I should see unit :arg1 on list
     */
    public function iShouldSeeUnitOnList($unitName)
    {
        $found = array_filter(
            $this->unitsList,
            function (UnitListItem $unitListItem) use ($unitName) {
                return $unitListItem->getName() == $unitName;
            }
        );

        if (!$found) {
            throw new \Exception(sprintf('Unit %s is not found', $unitName));
        }
    }

    /**
     * @When I edit unit :arg1 with new name :arg2 and :arg3 shortcut
     */
    public function iEditUnitWithNewNameAndShortcut($unitName, $newName, $newShortcut)
    {
        /** @var UnitListItem[] $units */
        $units = array_filter(
            $this->unitsList,
            function (UnitListItem $unitListItem) use ($unitName) {
                return $unitListItem->getName() == $unitName;
            }
        );

        $unitId = null;
        if (count($units)) {
            $unitId = $units[0]->getId();
        }
        $this->editUnitUseCase->execute(new EditUnitRequest($unitId, $newName, $newShortcut));
    }

    /**
     * @param CreateUnitResponse $response
     */
    public function unitCreated(CreateUnitResponse $response)
    {
    }

    /**
     * @param UnitListResponse $response
     */
    public function unitListFetched(UnitListResponse $response)
    {
        $this->unitsList = $response->getList();
    }

    /**
     * @param EditUnitResponse $response
     */
    public function unitUpdated(EditUnitResponse $response)
    {
    }

    /**
     * @return void
     */
    public function unitNotFound()
    {
    }
}