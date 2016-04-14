<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Domain\Category\Category;
use Behat\Domain\Category\CategoryRepository;
use Behat\Domain\Material\MaterialFactory;
use Behat\Domain\Material\MaterialRepository;
use Behat\Domain\Unit\Unit;
use Behat\Domain\Unit\UnitRepository;
use Behat\Gherkin\Node\TableNode;
use Domain\Category\Entity\CategoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\Material\MaterialFactoryInterface;
use Domain\Material\Repository\MaterialRepositoryInterface;
use Domain\Material\UseCase\CreateMaterial\CreateMaterialRequest;
use Domain\Material\UseCase\CreateMaterial\CreateMaterialResponderInterface;
use Domain\Material\UseCase\CreateMaterial\CreateMaterialUseCase;
use Domain\Material\UseCase\EditMaterial\EditMaterialRequest;
use Domain\Material\UseCase\EditMaterial\EditMaterialResponderInterface;
use Domain\Material\UseCase\EditMaterial\EditMaterialUseCase;
use Domain\Material\UseCase\ListMaterial\ListMaterialResponderInterface;
use Domain\Material\UseCase\ListMaterial\ListMaterialItem;
use Domain\Material\UseCase\ListMaterial\ListMaterialResponse;
use Domain\Material\UseCase\ListMaterial\ListMaterialUseCase;
use Domain\Unit\Enitity\UnitInterface;
use Domain\Unit\Repository\UnitRepositoryInterface;

/**
 * Class MaterialFeatureContext
 *
 * @package Behat\Domain
 */
class MaterialFeatureContext implements
    SnippetAcceptingContext,
    ListMaterialResponderInterface,
    CreateMaterialResponderInterface,
    EditMaterialResponderInterface
{

    /** @var  CreateMaterialUseCase */
    private $createMaterialUseCase;

    /** @var  ListMaterialUseCase */
    private $listMaterialUseCase;

    /** @var  EditMaterialUseCase */
    private $editMaterialUseCase;

    /** @var  CategoryRepositoryInterface */
    private $categoryRepository;

    /** @var  UnitRepositoryInterface */
    private $unitRepository;

    /** @var  MaterialRepositoryInterface */
    private $materialRepository;

    /** @var  MaterialFactoryInterface */
    private $materialFactory;

    /** @var  ListMaterialItem[] */
    private $materialList;

    /** @var  CategoryInterface */
    private $categoryCallWarningLimitationAssignOnlyToLeaf;

    /**
     * MaterialFeatureContext constructor.
     */
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->unitRepository = new UnitRepository();
        $this->materialRepository = new MaterialRepository();
        $this->materialFactory = new MaterialFactory();

        $this->createMaterialUseCase = new CreateMaterialUseCase(
            $this->materialRepository,
            $this->materialFactory
        );

        $this->listMaterialUseCase = new ListMaterialUseCase(
            $this->materialRepository
        );

        $this->editMaterialUseCase = new EditMaterialUseCase(
            $this->materialRepository
        );

        $this->listMaterialUseCase->addResponder($this);
        $this->editMaterialUseCase->addResponder($this);
        $this->createMaterialUseCase->addResponder($this);
    }

    /**
     * @Given I create root category :arg1
     */
    public function iCreateRootCategory($arg1)
    {
        $this->categoryRepository->add(new Category($arg1, true));
    }

    /**
     * @Given there are such categories:
     */
    public function thereAreSuchCategories(TableNode $table)
    {
        foreach ($table as $row) {
            $name = $row['name'];
            $parentName = $row['parent'];

            $parent = $this->getCategoryFromListByName($parentName);

            $category = new Category($name);
            $this->categoryRepository->add($category);
            $parent->addChild($category);
            $this->categoryRepository->update($parent);
        }
    }

    /**
     * @Given there are such units:
     */
    public function thereAreSuchUnits(TableNode $table)
    {
        foreach ($table as $row) {
            $this->unitRepository->add(new Unit($row['name'], $row['shortcut']));
        }
    }

    /**
     * @When I create material :arg1 and code :arg2 with unit :arg3 in category :arg4
     */
    public function iCreateMaterialAndCodeWithUnitInCategory($arg1, $arg2, $arg3, $arg4)
    {
        $unit = $this->getUnitFromListByName($arg3);
        $category = $this->getCategoryFromListByName($arg4);

        $this->createMaterialUseCase->execute(new CreateMaterialRequest($arg1, $arg2, $category, $unit));
    }

    /**
     * @When I listening materials
     */
    public function iListeningMaterials()
    {
        $this->listMaterialUseCase->execute();
    }

    /**
     * @Given there are such materials:
     */
    public function thereAreSuchMaterials(TableNode $table)
    {
        foreach ($table as $row) {
            $this->iCreateMaterialAndCodeWithUnitInCategory(
                $row['name'],
                $row['code'],
                $row['unit'],
                $row['category']
            );
        }
    }

    /**
     * @Then I should see given materials:
     */
    public function iShouldSeeGivenMaterials(TableNode $table)
    {
        $bugs = [];
        foreach ($table as $row) {
            $found = array_filter(
                $this->materialList,
                function (ListMaterialItem $item) use ($row) {
                    return $item->name == $row['name']
                    && $item->code == $row['code']
                    && $item->unitName == $row['unit']
                    && $item->categoryName == $row['category'];
                }
            );
            if (!$found) {
                $bugs[] = sprintf("Row |%s| not found on list", join('|', $row));
            }
        }

        if (count($bugs)) {
            throw new \Exception(join(". \n", $bugs));
        }
    }

    /**
     * @Then I should see material :arg1 on list
     */
    public function iShouldSeeMaterialOnList($arg1)
    {
        $found = array_filter(
            $this->materialList,
            function (ListMaterialItem $item) use ($arg1) {
                return $item->name == $arg1;
            }
        );

        if (!$found) {
            throw new \Exception(sprintf('Material %s is not found', $arg1));
        }
    }

    /**
     * @When I create material :arg1 and code :arg2 in category :arg3
     */
    public function iCreateMaterialAndCodeInCategory($arg1, $arg2, $arg3)
    {
        $category = $this->getCategoryFromListByName($arg3);
        $this->createMaterialUseCase->execute(new CreateMaterialRequest($arg1, $arg2, $category));
    }

    /**
     * @When I edit material :arg1 and change:
     */
    public function iEditMaterialAndChange($arg1, TableNode $table)
    {
        $this->iListeningMaterials();
        $items = array_filter(
            $this->materialList,
            function (ListMaterialItem $item) use ($arg1) {
                return $item->name == $arg1;
            }
        );

        $id = null;
        if (count($items)) {
            $id = array_values($items)[0]->id;
        }

        $row = array_values($table->getHash())[0];

        $newName = $row['name'];
        $newCode = $row['code'];
        $newCategory = $this->getCategoryFromListByName($row['category']);
        $newUnit = null;
        if (!empty($row['code'])) {
            $newUnit = $this->getUnitFromListByName($row['unit']);
        }

        $this->editMaterialUseCase->execute(new EditMaterialRequest($id, $newName, $newCode, $newCategory, $newUnit));
    }

    /**
     * @Then I should be notice of limitation - only leafs assign
     */
    public function iShouldBeNoticeOfLimitationOnlyLeafsAssign()
    {
        if (is_null($this->categoryCallWarningLimitationAssignOnlyToLeaf)) {
            throw new \Exception("Warning was not called");
        }
    }

    /**
     * @param string $name
     * @return CategoryInterface
     */
    private function getCategoryFromListByName($name)
    {
        /** @var CategoryInterface[] $items */
        $items = array_filter(
            $this->categoryRepository->findAll(),
            function (CategoryInterface $category) use ($name) {
                return $category->getName() == $name;
            }
        );

        $id = null;
        if (count($items)) {
            $id = array_values($items)[0]->getId();
        }

        return $this->categoryRepository->findById($id);
    }

    /**
     * @param string $name
     * @return UnitInterface
     */
    private function getUnitFromListByName($name)
    {
        /** @var UnitInterface[] $items */
        $items = array_filter(
            $this->unitRepository->findAll(),
            function (UnitInterface $unit) use ($name) {
                return $unit->getName() == $name;
            }
        );

        $id = null;
        if (count($items)) {
            $id = array_values($items)[0]->getId();
        }

        return $this->unitRepository->findById($id);
    }

    /**
     * @param ListMaterialResponse $response
     * @return void
     */
    public function listFetched(ListMaterialResponse $response)
    {
        $this->materialList = $response->items;
    }

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function callWarningLimitationAssignOnlyToLeaf(CategoryInterface $category)
    {
        $this->categoryCallWarningLimitationAssignOnlyToLeaf = $category;
    }
}