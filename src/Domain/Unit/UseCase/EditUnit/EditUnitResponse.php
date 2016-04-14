<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\EditUnit;

/**
 * Class EditUnitResponse
 *
 * @package Domain\Unit\UseCase\EditUnit
 */
class EditUnitResponse
{
    /** @var  string */
    private $name;

    /**
     * EditUnitResponse constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}