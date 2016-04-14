<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Unit\UseCase\ListUnit;

/**
 * Class UnitListResponse
 *
 * @package Domain\Unit\UseCase\ListUnit
 */
class UnitListResponse
{
    /**
     * @var UnitListItem[]
     */
    private $list;

    /**
     * UnitListResponse constructor.
     *
     * @param UnitListItem[] $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return UnitListItem[]
     */
    public function getList()
    {
        return $this->list;
    }
}