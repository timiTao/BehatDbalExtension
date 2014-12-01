<?php
/**
 * User: Tomasz Kunicki
 * Date: 01.12.2014
 */

namespace Behat\DbalExtension\Collection;

use Doctrine\DBAL\DriverManager;

/**
 * Class Factory
 *
 * @package Behat\DbalExtension\Collection
 */
class Factory
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @param array $parameters
     */
    function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return ConnectionCollection
     */
    public function factory()
    {
        $connectionsConfig = $this->parameters['dbal']['connections'];
        $list = [];
        foreach ($connectionsConfig as $key => $connectionConfig) {
            $connection = DriverManager::getConnection($connectionConfig);
            $list[$key] = $connection;
        }

        return new ConnectionCollection($list);
    }
}
