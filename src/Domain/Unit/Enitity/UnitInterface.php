<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\Enitity;

/**
 * Interface UnitInterface
 *
 * @package Domain\Unit\Enitity
 */
interface UnitInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getShortcut();

    /**
     * @param string $name
     * @param string $shortcut
     * @return void
     */
    public function compose($name, $shortcut);
}