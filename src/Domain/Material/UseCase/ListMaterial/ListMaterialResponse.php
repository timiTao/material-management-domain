<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\ListMaterial;

/**
 * Class ListMaterialResponse
 *
 * @package Domain\Material\UseCase\ListMaterial
 */
class ListMaterialResponse
{
    /** @var  ListMaterialItem[] */
    public $items;

    /**
     * ListMaterialResponse constructor.
     *
     * @param ListMaterialItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}