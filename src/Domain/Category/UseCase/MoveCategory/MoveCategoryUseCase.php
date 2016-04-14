<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Category\UseCase\MoveCategory;

use Domain\Category\Tree\TreeManager;
use Domain\Common\UseCase\ResponderAwareInterface;
use Domain\Common\UseCase\ResponderAwareTrait;

/**
 * Class MoveCategoryUseCase
 *
 * @package Domain\Category\UseCase\MoveCategory
 */
class MoveCategoryUseCase implements ResponderAwareInterface
{
    use ResponderAwareTrait;

    /** @var  TreeManager */
    private $treeManager;

    /**
     * MoveCategoryUseCase constructor.
     *
     * @param TreeManager $treeManager
     */
    public function __construct(TreeManager $treeManager)
    {
        $this->treeManager = $treeManager;
    }

    /**
     * @param MoveCategoryRequest $request
     */
    public function execute(MoveCategoryRequest $request)
    {
        $child = $request->getChild();
        $parent = $request->getNewParent();

        $this->treeManager->assignParent($child, $parent);
    }


}