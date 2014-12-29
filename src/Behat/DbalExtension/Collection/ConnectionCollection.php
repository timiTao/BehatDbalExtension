<?php
/**
 * User: Tomasz Kunicki
 * Date: 01.12.2014
 */

namespace Behat\DbalExtension\Collection;

use Behat\DbalExtension\Exception\DbalExtensionException;
use Doctrine\DBAL\Driver\Connection;

/**
 * Class ConnectionCollection
 *
 * @package Behat\DbalExtension\Collection
 */
class ConnectionCollection extends \ArrayObject implements ConnectionCollectionInterface
{
    /**
     * @param string $key
     * @return Connection
     * @throws \Behat\DbalExtension\Exception\DbalExtensionException
     */
    public function get($key)
    {
        if (!$this->offsetExists($key)) {
            throw new DbalExtensionException(sprintf("Connection on given key '%s' don't exists", $key));
        }
        return $this->offsetGet($key);
    }
}
