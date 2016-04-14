<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\EditCategory;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface EditCategoryResponderInterface
 *
 * @package Domain\Category\UseCase\EditCategory
 */
interface EditCategoryResponderInterface extends ResponderInterface
{
    /**
     * @return void
     */
    public function categoryUpdated();
}