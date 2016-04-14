<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Domain\Category\Category;
use Behat\Domain\Category\CategoryFactory;
use Behat\Domain\Category\CategoryRepository;
use Behat\Gherkin\Node\TableNode;
use Domain\Category\Entity\CategoryInterface;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Domain\Category\Tree\TreeManager;
use Domain\Category\UseCase\CreateCategory\CreateCategoryRequest;
use Domain\Category\UseCase\CreateCategory\CreateCategoryUseCase;
use Domain\Category\UseCase\EditCategory\EditCategoryRequest;
use Domain\Category\UseCase\EditCategory\EditCategoryUseCase;
use Domain\Category\UseCase\ListCategory\CategoryListItem;
use Domain\Category\UseCase\ListCategory\ListCategoryResponderInterface;
use Domain\Category\UseCase\ListCategory\ListCategoryResponse;
use Domain\Category\UseCase\ListCategory\ListCategoryUseCase;
use Domain\Category\UseCase\MoveCategory\MoveCategoryRequest;
use Domain\Category\UseCase\MoveCategory\MoveCategoryUseCase;

/**
 * Class CategoryFeatureContext
 *
 * @package Behat\Domain
 */
class CategoryFeatureContext implements
    SnippetAcceptingContext,
    ListCategoryResponderInterface
{
    /** @var  CreateCategoryUseCase */
    private $createCategoryUseCase;

    /** @var  ListCategoryUseCase */
    private $listCategoryUseCase;

    /** @var  EditCategoryUseCase */
    private $editCategoryUseCase;

    /** @var  MoveCategoryUseCase */
    private $moveCategoryUseCase;

    /** @var  TreeManager */
    private $treeManager;

    /** @var  CategoryRepositoryInterface */
    private $categoryRepository;

    /** @var  CategoryFactory */
    private $categoryFactory;

    /** @var  CategoryListItem[] */
    private $categoryItems;

    /**
     * CategoryFeatureContext constructor.
     */
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->categoryFactory = new CategoryFactory();

        $this->treeManager = new TreeManager(
            $this->categoryRepository
        );

        $this->createCategoryUseCase = new CreateCategoryUseCase(
            $this->categoryRepository,
            $this->categoryFactory,
            $this->treeManager
        );

        $this->listCategoryUseCase = new ListCategoryUseCase(
            $this->categoryRepository
        );

        $this->editCategoryUseCase = new EditCategoryUseCase(
            $this->categoryRepository
        );

        $this->moveCategoryUseCase = new MoveCategoryUseCase(
            $this->treeManager
        );

        $this->listCategoryUseCase->addResponder($this);
    }

    /**
     * @Then I listening categories
     */
    public function iListeningCategories()
    {
        $this->listCategoryUseCase->execute();
    }

    /**
     * @Then I should see category :arg1 on list
     */
    public function iShouldSeeCategoryOnList($arg1)
    {
        $found = array_filter(
            $this->categoryItems,
            function (CategoryListItem $categoryListItem) use ($arg1) {
                return $categoryListItem->getName() == $arg1;
            }
        );

        if (!$found) {
            throw new \Exception(sprintf('Unit %s is not found', $arg1));
        }
    }

    /**
     * @Given there are such categories:
     */
    public function thereAreSuchCategories(TableNode $table)
    {
        foreach ($table as $row) {
            $this->iCreateCategoryWithParent($row['name'], $row['parent']);
        }
    }

    /**
     * @Then I should see given categories:
     *
     * @param TableNode $table
     * @throws \Exception
     */
    public function iShouldSeeGivenCategories(TableNode $table)
    {
        foreach ($table as $row) {
            $found = array_filter(
                $this->categoryItems,
                function (CategoryListItem $categoryListItem) use ($row) {
                    return $categoryListItem->getName() == $row['name'];
                }
            );

            if (!$found) {
                throw new \Exception(sprintf('Category %s is not found', $row['name']));
            }
        }
    }

    /**
     * @When I edit category :arg1 with new name :arg2
     */
    public function iEditUnitWithNewName($arg1, $arg2)
    {
        $this->iListeningCategories();
        /** @var CategoryListItem[] $items */
        $items = array_filter(
            $this->categoryItems,
            function (CategoryListItem $categoryListItem) use ($arg1) {
                return $categoryListItem->getName() == $arg1;
            }
        );

        $id = null;
        if (count($items)) {
            $id = $items[0]->getId();
        }

        $this->editCategoryUseCase->execute(new EditCategoryRequest($id, $arg2));
    }

    /**
     * @Given I create root category :arg1
     */
    public function iCreateRootCategory($arg1)
    {
        $rootCategory = $this->categoryRepository->findRootCategory();
        if ($rootCategory) {
            throw new \Exception('Root category exist with name ', $rootCategory->getName());
        }

        $category = new Category($arg1, true);
        $this->categoryRepository->add($category);
    }

    /**
     * @When I create category :arg1 with parent :arg2
     */
    public function iCreateCategoryWithParent($arg1, $arg2)
    {
        $this->iListeningCategories();
        $parent = $this->getCategoryFromListByName($arg2);

        $this->createCategoryUseCase->execute(new CreateCategoryRequest($arg1, $parent));
    }

    /**
     * @When I change parent of :arg1 to new :arg2
     */
    public function iChangeParentOfToNew($arg1, $arg2)
    {
        $this->iListeningCategories();
        $child = $this->getCategoryFromListByName($arg1);
        $parent = $this->getCategoryFromListByName($arg2);

        $this->moveCategoryUseCase->execute(new MoveCategoryRequest($child, $parent));
    }

    /**
     * @Then Categories should have relation to parent:
     */
    public function categoriesShouldHaveRelationToParent(TableNode $table)
    {
        $bugs = [];
        foreach ($table as $row) {
            $child = $this->getCategoryFromListByName($row['name']);
            $parent = $this->getCategoryFromListByName($row['parent']);

            $actualParent = $this->categoryRepository->getParent($child);
            if (is_null($actualParent)) {
                $bugs[] = sprintf("The relation child '%s' don't have parent", $row['name']);
                continue;
            }

            if ($actualParent->getId() != $parent->getId()) {
                $bugs[] = sprintf("The relation child '%s' to parent '%s' don't exist", $row['name'], $row['parent']);
                continue;
            }
        }

        if (count($bugs)) {
            throw new \Exception(join(". \n", $bugs));
        }
    }

    /**
     * @Then Categories should have own to child:
     */
    public function categoriesShouldHaveOwnToChild(TableNode $table)
    {
        $bugs = [];
        foreach ($table as $row) {
            $parent = $this->getCategoryFromListByName($row['name']);
            $child = $this->getCategoryFromListByName($row['child']);

            if (!$parent->hasChild($child)) {
                $bugs[] = sprintf("The relation parent '%s' to child '%s' don't exist", $row['name'], $row['child']);
                continue;
            }
        }

        if (count($bugs)) {
            throw new \Exception(join(". \n", $bugs));
        }
    }

    /**
     * @param ListCategoryResponse $response
     * @return void
     */
    public function listFetched(ListCategoryResponse $response)
    {
        $this->categoryItems = $response->items;
    }

    /**
     * @param string $name
     * @return CategoryInterface
     */
    private function getCategoryFromListByName($name)
    {
        /** @var CategoryListItem[] $items */
        $items = array_filter(
            $this->categoryItems,
            function (CategoryListItem $categoryListItem) use ($name) {
                return $categoryListItem->getName() == $name;
            }
        );

        $id = null;
        if (count($items)) {
            $id = array_values($items)[0]->getId();
        }

        return $this->categoryRepository->findById($id);
    }
}