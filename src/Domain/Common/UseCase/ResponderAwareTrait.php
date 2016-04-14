<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Common\UseCase;

/**
 * Class ResponderAwareTrait
 *
 * @package Domain\Common\UseCase
 */
trait ResponderAwareTrait
{
    /**
     * @var ResponderInterface[]
     */
    private $responders = [];

    /**
     * @param ResponderInterface $responder
     */
    public function addResponder(ResponderInterface $responder)
    {
        $this->responders[] = $responder;
    }
}