<?php
/**
 * User: Tomasz Kunicki
 * Date: 01.12.2014
 */

namespace Behat\DbalExtension\Collection;

use Doctrine\DBAL\Driver\Connection;

/**
 * Class ConnectionCollection
 *
 * @package Behat\DbalExtension\Collection
 */
class ConnectionCollection extends \ArrayObject
{
    /**
     * @param Connection $key
     * @return Connection
     */
    public function get($key)
    {
        return $this->offsetGet($key);
    }
} 