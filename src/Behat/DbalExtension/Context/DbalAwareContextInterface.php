<?php
/**
 * User: Tomasz Kunicki
 * Date: 24.11.2014
 */

namespace Behat\DbalExtension\Context;

use Doctrine\DBAL\Connection;

/**
 * Interface DoctrineDbalAwareContextInterface
 * @package Behat\DbalExtension\Context
 */
interface DbalAwareContextInterface
{
    /**
     * Sets connection instance.
     *
     * @param Connection $connection
     * @return void
     */
    public function setConnection(Connection $connection);
}
