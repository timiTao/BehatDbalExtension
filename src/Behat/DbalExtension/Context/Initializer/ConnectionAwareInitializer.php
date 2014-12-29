<?php
/**
 * User: Tomasz Kunicki
 * Date: 24.11.2014
 */
namespace Behat\DbalExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\DbalExtension\Collection\ConnectionInterface;
use Behat\DbalExtension\Context\ConnectionAwareContextInterface;

/**
 * Class ConnectionAwareInitializer
 *
 * @package Behat\DbalExtension\Context\Initializer
 */
class ConnectionAwareInitializer implements ContextInitializer
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * Initializes initializer.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof ConnectionAwareContextInterface) {
            return;
        }

        $context->setConnection($this->connection);
    }
}
