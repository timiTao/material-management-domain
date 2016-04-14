<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\EditUnit;

/**
 * Class EditUnitRequest
 *
 * @package Domain\Unit\UseCase\EditUnit
 */
class EditUnitRequest
{
    /** @var  integer */
    private $unitId;

    /** @var  string */
    private $name;

    /** @var  string */
    private $shortcut;

    /**
     * EditUnitRequest constructor.
     *
     * @param int $unitId
     * @param string $name
     * @param string $shortcut
     */
    public function __construct($unitId, $name, $shortcut)
    {
        $this->unitId = $unitId;
        $this->name = $name;
        $this->shortcut = $shortcut;
    }

    /**
     * @return int
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }
}