<?php
/**
 * User: Tomasz Kunicki
 * Date: 29.12.2014
 */
namespace Behat\DbalExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\DbalExtension\Collection\ConnectionCollectionInterface;
use Behat\DbalExtension\Context\CollectionAwareContextInterface;

/**
 * Class CollectionAwareInitializer
 *
 * @package Behat\DbalExtension\Context\Initializer
 */
class CollectionAwareInitializer implements ContextInitializer
{
    /**
     * @var string
     */
    protected $defaultAlias;

    /**
     * @var ConnectionCollectionInterface
     */
    protected $collection;

    /**
     * @param $defaultAlias
     * @param ConnectionCollectionInterface $collection
     */
    function __construct($defaultAlias, $collection)
    {
        $this->defaultAlias = $defaultAlias;
        $this->collection = $collection;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof CollectionAwareContextInterface) {
            return;
        }

        $context->setConnectionCollection($this->collection);
        $context->setDefaultAlias($this->defaultAlias);
    }
}
