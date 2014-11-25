<?php
/**
 * User: Tomasz Kunicki
 * Date: 24.11.2014
 */

namespace Behat\DbalExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\DbalExtension\Context\DbalAwareContextInterface;
use Doctrine\DBAL\Connection;

/**
 * Class DoctrineDbalAwareInitializer
 */
class DbalAwareInitializer implements ContextInitializer
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     * Initializes initializer.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
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
        if (!$context instanceof DbalAwareContextInterface) {
            return;
        }
        $context->setConnection($this->connection);
    }
}
