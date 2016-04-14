<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Material\UseCase\EditMaterial;

use Domain\Category\Entity\CategoryInterface;
use Domain\Common\UseCase\ResponderInterface;

/**
 * Interface EditMaterialResponderInterface
 *
 * @package Domain\Material\UseCase\EditMaterial
 */
interface EditMaterialResponderInterface extends ResponderInterface
{
    /**
     * @param CategoryInterface $category
     * @return void
     */
    public function callWarningLimitationAssignOnlyToLeaf(CategoryInterface $category);
}