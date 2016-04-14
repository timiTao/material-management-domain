<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\CreateUnit;

/**
 * Class CreateUnitResponseInterface
 *
 * @package Domain\Unit\UseCase\CreateUnit
 */
class CreateUnitResponse
{
    /**
     * @var string
     */
    private $unitName;

    /**
     * CreateUnitResponse constructor.
     *
     * @param string $unitName
     */
    public function __construct($unitName)
    {
        $this->unitName = $unitName;
    }

    /**
     * @return string
     */
    public function getNewUnitName()
    {
        return $this->unitName;
    }
}