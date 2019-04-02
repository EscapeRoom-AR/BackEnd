<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Hint as ChildHint;
use Model\HintQuery as ChildHintQuery;
use Model\Map\HintTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'hint' table.
 *
 *
 *
 * @method     ChildHintQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHintQuery orderByHint($order = Criteria::ASC) Order by the hint column
 * @method     ChildHintQuery orderByItemCode($order = Criteria::ASC) Order by the item_code column
 *
 * @method     ChildHintQuery groupById() Group by the id column
 * @method     ChildHintQuery groupByHint() Group by the hint column
 * @method     ChildHintQuery groupByItemCode() Group by the item_code column
 *
 * @method     ChildHintQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHintQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHintQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHintQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHintQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHintQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHintQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildHintQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildHintQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildHintQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildHintQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildHintQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildHintQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     \Model\ItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHint findOne(ConnectionInterface $con = null) Return the first ChildHint matching the query
 * @method     ChildHint findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHint matching the query, or a new ChildHint object populated from the query conditions when no match is found
 *
 * @method     ChildHint findOneById(int $id) Return the first ChildHint filtered by the id column
 * @method     ChildHint findOneByHint(string $hint) Return the first ChildHint filtered by the hint column
 * @method     ChildHint findOneByItemCode(int $item_code) Return the first ChildHint filtered by the item_code column *

 * @method     ChildHint requirePk($key, ConnectionInterface $con = null) Return the ChildHint by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHint requireOne(ConnectionInterface $con = null) Return the first ChildHint matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHint requireOneById(int $id) Return the first ChildHint filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHint requireOneByHint(string $hint) Return the first ChildHint filtered by the hint column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHint requireOneByItemCode(int $item_code) Return the first ChildHint filtered by the item_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHint[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHint objects based on current ModelCriteria
 * @method     ChildHint[]|ObjectCollection findById(int $id) Return ChildHint objects filtered by the id column
 * @method     ChildHint[]|ObjectCollection findByHint(string $hint) Return ChildHint objects filtered by the hint column
 * @method     ChildHint[]|ObjectCollection findByItemCode(int $item_code) Return ChildHint objects filtered by the item_code column
 * @method     ChildHint[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HintQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\HintQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Hint', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHintQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHintQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHintQuery) {
            return $criteria;
        }
        $query = new ChildHintQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildHint|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HintTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HintTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHint A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, hint, item_code FROM hint WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildHint $obj */
            $obj = new ChildHint();
            $obj->hydrate($row);
            HintTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildHint|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HintTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HintTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HintTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HintTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HintTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the hint column
     *
     * Example usage:
     * <code>
     * $query->filterByHint('fooValue');   // WHERE hint = 'fooValue'
     * $query->filterByHint('%fooValue%', Criteria::LIKE); // WHERE hint LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hint The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function filterByHint($hint = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hint)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HintTableMap::COL_HINT, $hint, $comparison);
    }

    /**
     * Filter the query on the item_code column
     *
     * Example usage:
     * <code>
     * $query->filterByItemCode(1234); // WHERE item_code = 1234
     * $query->filterByItemCode(array(12, 34)); // WHERE item_code IN (12, 34)
     * $query->filterByItemCode(array('min' => 12)); // WHERE item_code > 12
     * </code>
     *
     * @see       filterByItem()
     *
     * @param     mixed $itemCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function filterByItemCode($itemCode = null, $comparison = null)
    {
        if (is_array($itemCode)) {
            $useMinMax = false;
            if (isset($itemCode['min'])) {
                $this->addUsingAlias(HintTableMap::COL_ITEM_CODE, $itemCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemCode['max'])) {
                $this->addUsingAlias(HintTableMap::COL_ITEM_CODE, $itemCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HintTableMap::COL_ITEM_CODE, $itemCode, $comparison);
    }

    /**
     * Filter the query by a related \Model\Item object
     *
     * @param \Model\Item|ObjectCollection $item The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHintQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof \Model\Item) {
            return $this
                ->addUsingAlias(HintTableMap::COL_ITEM_CODE, $item->getCode(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HintTableMap::COL_ITEM_CODE, $item->toKeyValue('PrimaryKey', 'Code'), $comparison);
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type \Model\Item or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation Item object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\Model\ItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHint $hint Object to remove from the list of results
     *
     * @return $this|ChildHintQuery The current query, for fluid interface
     */
    public function prune($hint = null)
    {
        if ($hint) {
            $this->addUsingAlias(HintTableMap::COL_ID, $hint->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hint table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HintTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HintTableMap::clearInstancePool();
            HintTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HintTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HintTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HintTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HintTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HintQuery
