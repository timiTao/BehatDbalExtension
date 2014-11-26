<?php

namespace Behat\DbalExtension\Context;

use Behat\Behat\Context\Context;
use Doctrine\DBAL\Connection;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, DbalAwareContextInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var
     */
    protected $baseSqlPath;

    /**
     * @param $baseSqlPath
     */
    function __construct($baseSqlPath = '')
    {
        $this->baseSqlPath = $baseSqlPath;
    }


    /**
     * Sets connection instance.
     *
     * @param Connection $connection
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    protected function getQueryBuilder()
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * @Given Dbal load data to table :arg1 :
     *
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
        $stmt = $this->connection->prepare($arg1);
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

    /**
     * @Given Dbal load file :arg1
     *
     * @param string $path
     * @throws \Exception
     */
    public function dbalLoadFile($path)
    {
        $fullPath = $this->baseSqlPath . $path;
        if (!file_exists($fullPath)) {
            throw new \Exception(sprintf("File %s don't exists in base folder '%s'", $path, $this->baseSqlPath));
        }
        $content = file_get_contents($fullPath);
        $this->dbalRunSql($content);
    }
}
