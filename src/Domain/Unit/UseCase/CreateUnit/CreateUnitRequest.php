<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\CreateUnit;

/**
 * Class CreateUnitRequest
 *
 * @package Domain\Unit\UseCase\CreateUnit
 */
class CreateUnitRequest
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shortcut;

    /**
     * CreateUnitRequest constructor.
     *
     * @param string $name
     * @param string $shortcut
     */
    public function __construct($name, $shortcut)
    {
        $this->name = $name;
        $this->shortcut = $shortcut;
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