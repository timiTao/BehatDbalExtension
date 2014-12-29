<?php
/**
 * User: Tomasz Kunicki
 * Date: 24.11.2014
 */
namespace Behat\DbalExtension\Context;

use Behat\DbalExtension\Collection\ConnectionInterface;

/**
 * Interface ConnectionAwareContextInterface
 *
 * @package Behat\DbalExtension\Context
 */
interface ConnectionAwareContextInterface
{
    /**
     * Sets connection instance.
     *
     * @param ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection);
}
