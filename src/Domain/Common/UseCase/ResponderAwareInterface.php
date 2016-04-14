<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Common\UseCase;

/**
 * Interface ResponderAwareInterface
 *
 * @package Domain\Common\UseCase
 */
interface ResponderAwareInterface
{
    /**
     * @param ResponderInterface $responder
     * @return void
     */
    public function addResponder(ResponderInterface $responder);
}