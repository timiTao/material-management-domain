<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\ListMaterial;

use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface ListMaterialResponderInterface
 *
 * @package Domain\Material\UseCase\ListMaterial
 */
interface ListMaterialResponderInterface extends ResponderInterface
{
    /**
     * @param ListMaterialResponse $response
     * @return void
     */
    public function listFetched(ListMaterialResponse $response);
}