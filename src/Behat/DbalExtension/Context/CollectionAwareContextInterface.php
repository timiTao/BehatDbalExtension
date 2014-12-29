<?php
/**
 * User: Tomasz Kunicki
 * Date: 29.12.2014
 */
namespace Behat\DbalExtension\Context;

use Behat\DbalExtension\Collection\ConnectionCollectionInterface;

/**
 * Interface DbalCollectionAwareContextInterface
 *
 * @package Behat\DbalExtension\Context
 */
interface CollectionAwareContextInterface
{
    /**
     * @param ConnectionCollectionInterface $connectionCollection
     * @return void
     */
    public function setConnectionCollection(ConnectionCollectionInterface $connectionCollection);

    /**
     * @param string $alias
     * @return void
     */
    public function setDefaultAlias($alias);
}
