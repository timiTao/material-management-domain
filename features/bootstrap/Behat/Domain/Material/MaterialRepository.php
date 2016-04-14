<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Material;

use Domain\Material\Enitity\MaterialInterface;
use Domain\Material\Repository\MaterialRepositoryInterface;

/**
 * Class MaterialRepository
 *
 * @package Behat\Domain\Material
 */
class MaterialRepository implements MaterialRepositoryInterface
{
    /** @var  MaterialInterface[] */
    private $list;

    public function __construct()
    {
        $this->list = [];
    }

    /**
     * @param MaterialInterface $material
     * @return void
     */
    public function add(MaterialInterface $material)
    {
        $this->list[] = $material;
    }

    /**
     * @return MaterialInterface[]
     */
    public function findAll()
    {
        return $this->list;
    }

    /**
     * @param integer $id
     * @return MaterialInterface|null
     */
    public function findById($id)
    {
        foreach ($this->list as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
    }

    /**
     * @param MaterialInterface $material
     * @return void
     */
    public function update(MaterialInterface $material)
    {
        foreach ($this->list as $key => $item) {
            if ($item->getId() == $material->getId()) {
                $this->list[$key] = $material;
                break;
            }
        }
    }
}