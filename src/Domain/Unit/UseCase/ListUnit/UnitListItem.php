<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\ListUnit;

/**
 * Class UnitListItem
 *
 * @package Domain\Unit\UseCase\ListUnit
 */
class UnitListItem
{
    /** @var integer */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $shortcut;

    /**
     * UnitListItem constructor.
     *
     * @param integer $id
     * @param string $name
     * @param string $shortcut
     */
    public function __construct($id, $name, $shortcut)
    {
        $this->id = $id;
        $this->name = $name;
        $this->shortcut = $shortcut;
    }
}
