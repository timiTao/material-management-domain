<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Category;

use Domain\Category\Entity\CategoryInterface;

/**
 * Class Category
 *
 * @package Behat\Domain\Category
 */
class Category implements CategoryInterface
{

    /** @var string */
    private $id;

    /** @var  string */
    private $name;

    /** @var bool */
    private $isRoot;

    /** @var  CategoryInterface[] */
    private $children;

    /**
     * Category constructor.
     *
     * @param $name
     * @param array $children
     * @param bool $isRoot
     */
    public function __construct($name, $isRoot = false, $children = [])
    {
        $this->id = md5(microtime());
        $this->name = $name;
        $this->setChildren($children);
        $this->isRoot = $isRoot;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function compose($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isRoot()
    {
        return $this->isRoot;
    }

    /**
     * @param CategoryInterface $child
     * @return void
     */
    public function addChild(CategoryInterface $child)
    {
        $this->children[] = $child;
    }

    /**
     * @return CategoryInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param CategoryInterface[] $children
     */
    private function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @param CategoryInterface $child
     * @return bool
     */
    public function hasChild(CategoryInterface $category)
    {
        /** @var CategoryInterface $child */
        foreach ($this->children as $child) {
            if ($child->getId() == $category->getId()) {
                return true;
            }
        }
    }

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function removeChild(CategoryInterface $category)
    {
        $list = $this->children;
        /** @var CategoryInterface $child */
        foreach ($list as $key => $child) {
            if ($child->getId() == $this->getId()) {
                unset($list[$key]);
            }
        }
        $this->setChildren($list);
    }
}