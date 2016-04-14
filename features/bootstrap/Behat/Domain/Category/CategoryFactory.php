<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Category;

use Domain\Category\CategoryFactoryInterface;
use Domain\Category\Entity\CategoryInterface;

/**
 * Class CategoryFactory
 *
 * @package Behat\Domain\Category
 */
class CategoryFactory implements CategoryFactoryInterface
{
    /**
     * @param $name
     * @return CategoryInterface
     */
    public function create($name)
    {
        return new Category($name);
    }
}