<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\ListCategory;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface ListCategoryResponderInterface
 *
 * @package Domain\Category\UseCase\ListCategory
 */
interface ListCategoryResponderInterface extends ResponderInterface
{
    /**
     * @param ListCategoryResponse $response
     * @return void
     */
    public function listFetched(ListCategoryResponse $response);
}