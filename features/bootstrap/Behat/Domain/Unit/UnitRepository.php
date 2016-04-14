<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Unit;

use Domain\Unit\Enitity\UnitInterface;
use Domain\Unit\Repository\UnitRepositoryInterface;

/**
 * Class UnitRepository
 *
 * @package Unit
 */
class UnitRepository implements UnitRepositoryInterface
{

    /**
     * @var UnitInterface[]
     */
    private $list;

    /**
     * UnitRepository constructor.
     *
     * @param \Domain\Unit\Enitity\UnitInterface[] $list
     */
    public function __construct(array $list = array())
    {
        $this->list = $list;
    }

    /**
     * @param UnitInterface $unit
     * @return void
     */
    public function add(UnitInterface $unit)
    {
        $this->list[] = $unit;
    }

    /**
     * @return UnitInterface[]
     */
    public function findAll()
    {
        return $this->list;
    }

    /**
     * @param integer $id
     * @return UnitInterface|null
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
     * @param UnitInterface $unit
     * @return void
     */
    public function update(UnitInterface $unit)
    {
        foreach ($this->list as $key => $item) {
            if ($item->getId() == $unit->getId()) {
                $this->list[$key] = $unit;
                break;
            }
        }
    }
}