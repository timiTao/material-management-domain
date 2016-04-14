<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\CreateMaterial;

use Domain\Category\Entity\CategoryInterface;

/**
 * Interface CreateMaterialResponderInterface
 *
 * @package Domain\Material\UseCase\CreateMaterial
 */
interface CreateMaterialResponderInterface
{
    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function callWarningLimitationAssignOnlyToLeaf(CategoryInterface $category);
}