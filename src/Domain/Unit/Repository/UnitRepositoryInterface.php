<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\Repository;

use Domain\Unit\Enitity\UnitInterface;

/**
 * Interface UnitRepositoryInterface
 *
 * @package Domain\Unit\Repository
 */
interface UnitRepositoryInterface
{
    /**
     * @param UnitInterface $unit
     * @return void
     */
    public function add(UnitInterface $unit);

    /**
     * @return UnitInterface[]
     */
    public function findAll();

    /**
     * @param integer $id
     * @return UnitInterface|null
     */
    public function findById($id);

    /**
     * @param UnitInterface $unit
     * @return void
     */
    public function update(UnitInterface $unit);

}