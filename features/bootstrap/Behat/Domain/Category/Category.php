<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\Domain\Category;

use Domain\Category\Entity\CategoryInterface;

/**
 * Class Category
 *
 * @package Behat\Domain\Category
 */
class Category implements CategoryInterface
{
    /** @var string */
    private $id;

    /** @var  string */
    private $name;

    /**
     * Category constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->id = md5(microtime());
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function compose($name)
    {
        $this->name = $name;
    }
}
