<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\Repository;

use Domain\Material\Enitity\MaterialInterface;

/**
 * Interface MaterialRepository
 *
 * @package Domain\Material\Repository
 */
interface MaterialRepositoryInterface
{
    /**
     * @param MaterialInterface $material
     * @return void
     */
    public function add(MaterialInterface $material);

    /**
     * @return MaterialInterface[]
     */
    public function findAll();

    /**
     * @param $id
     * @return MaterialInterface
     */
    public function findById($id);

    /**
     * @param MaterialInterface $material
     * @return void
     */
    public function update(MaterialInterface $material);
}