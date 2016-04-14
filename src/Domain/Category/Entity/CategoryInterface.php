<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\Entity;

/**
 * Interface CategoryInterface
 *
 * @package Domain\Category\Entity
 */
interface CategoryInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function compose($name);

    /**
     * @return boolean
     */
    public function isRoot();

    /**
     * @param CategoryInterface $child
     * @return void
     */
    public function addChild(CategoryInterface $child);

    /**
     * @return CategoryInterface[]
     */
    public function getChildren();

    /**
     * @param CategoryInterface $child
     * @return bool
     */
    public function hasChild(CategoryInterface $child);

    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function removeChild(CategoryInterface $category);
}