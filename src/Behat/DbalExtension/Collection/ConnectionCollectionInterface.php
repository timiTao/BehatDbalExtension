<?php
/**
 * User: Tomasz Kunicki
 * Date: 29.12.2014
 */
namespace Behat\DbalExtension\Collection;

/**
 * Class ConnectionCollection
 *
 * @package Behat\DbalExtension\Collection
 */
interface ConnectionCollectionInterface
{
    /**
     * @param string $key
     * @return ConnectionInterface
     */
    public function get($key);
}
