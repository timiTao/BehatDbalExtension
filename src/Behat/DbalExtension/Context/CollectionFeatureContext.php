<?php
/**
 * User: Tomasz Kunicki
 * Date: 29.12.2014
 */
namespace Behat\DbalExtension\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\DbalExtension\Collection\ConnectionCollectionInterface;
use Behat\Gherkin\Node\TableNode;

/**
 * Class ConnectionCollectionFeatureContext
 *
 * @package Behat\DbalExtension\Context
 */
class CollectionFeatureContext implements Context, SnippetAcceptingContext, CollectionAwareContextInterface
{
    /**
     * @var ConnectionCollectionInterface
     */
    protected $connectionCollection;

    /**
     * @var string
     */
    protected $currentAlias;

    /**
     * @param ConnectionCollectionInterface $connectionCollection
     * @return void
     */
    public function setConnectionCollection(ConnectionCollectionInterface $connectionCollection)
    {
        $this->connectionCollection = $connectionCollection;
    }

    /**
     * @param string $alias
     * @return void
     */
    public function setDefaultAlias($alias)
    {
        $this->currentAlias = $alias;
    }

    /**
     * @return \Behat\DbalExtension\Collection\ConnectionInterface
     */
    protected function getCurrentConnection()
    {
        return $this->connectionCollection->get($this->currentAlias);
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    protected function getQueryBuilder()
    {
        return $this->getCurrentConnection()->createQueryBuilder();
    }

    /**
     * @Given Dbal set current connection alias as :arg1
     *
     * @param string $alias
     */
    public function setCurrentAlias($alias)
    {
        $this->currentAlias = $alias;
    }

    /**
     * @Given Dbal load data to table :arg2 :
     *
     * @param $string
     * @param TableNode $table
     */
    public function apiForm($string, TableNode $table)
    {
        $queryBuilder = $this->getQueryBuilder();
        foreach ($table as $row) {
            $queryBuilder->insert($string);
            $i = 0;
            foreach ($row as $columnName => $value) {
                $queryBuilder
                    ->setValue($columnName, '?')
                    ->setParameter($i, $value);
                $i++;
            }
            $queryBuilder->execute();
        }
    }

    /**
     * @Given Dbal run sql :arg1
     */
    public function dbalRunSql($arg1)
    {
        $stmt = $this->getCurrentConnection()->prepare($arg1);
        $stmt->execute();
    }

    /**
     * @Given Dbal truncate table :arg1
     */
    public function dbalTruncateTable($arg1)
    {
        $this->getQueryBuilder()
            ->delete($arg1)
            ->execute();
    }

    /**
     * @Given Dbal expect to have in table :arg1 at least:
     *
     * @param $arg1
     * @param TableNode $table
     * @throws \Exception
     */
    public function dbalExpectToHaveInTableAtLast($arg1, TableNode $table)
    {
        foreach ($table as $row) {
            $queryBuilder = $this->getQueryBuilder();
            $queryBuilder->select('count(*) as count')
                ->from($arg1);

            $i = 0;
            foreach ($row as $column => $value) {
                $queryBuilder->andWhere(sprintf(" %s = ?", $column))
                    ->setParameter($i, $value);
                $i++;
            }

            $result = $queryBuilder->execute()->fetch();

            if ($result['count'] == 0) {
                throw new \Exception(sprintf("Table '%s' don't have row given data: [%s]", $arg1, json_encode($row)));
            }
        }
    }
}
