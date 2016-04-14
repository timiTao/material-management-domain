<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category;

use Domain\Category\Entity\CategoryInterface;

/**
 * Interface CategoryFactoryInterface
 *
 * @package Domain\Category
 */
interface CategoryFactoryInterface
{
    /**
     * @param $name
     * @return CategoryInterface
     */
    public function create($name);
}