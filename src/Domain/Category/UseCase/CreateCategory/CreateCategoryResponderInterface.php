<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\CreateCategory;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface CreateCategoryResponderInterface
 *
 * @package Domain\Category\UseCase\CreateCategory
 */
interface CreateCategoryResponderInterface extends ResponderInterface
{
    /**
     * @return void
     */
    public function categoryCreated();
}