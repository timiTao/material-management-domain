<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Domain\Unit;

use Domain\Unit\Enitity\UnitInterface;

/**
 * Class Unit
 */
class Unit implements UnitInterface
{
    private $id;
    private $name;
    private $shortcut;

    /**
     * Unit constructor.
     *
     * @param $name
     * @param $shortcut
     */
    public function __construct($name, $shortcut)
    {
        $this->id = md5(microtime());
        $this->name = $name;
        $this->shortcut = $shortcut;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }

    /**
     * @param string $name
     * @param string $shortcut
     * @return void
     */
    public function compose($name, $shortcut)
    {
        $this->name = $name;
        $this->shortcut = $shortcut;
    }
}