<?php

namespace API\Model\Base;

use \Exception;
use \PDO;
use API\Model\Assignment as ChildAssignment;
use API\Model\AssignmentQuery as ChildAssignmentQuery;
use API\Model\Map\AssignmentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'assignment' table.
 *
 *
 *
 * @method     ChildAssignmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAssignmentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildAssignmentQuery orderByTeacherId($order = Criteria::ASC) Order by the teacher_id column
 * @method     ChildAssignmentQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildAssignmentQuery orderByHours($order = Criteria::ASC) Order by the hours column
 *
 * @method     ChildAssignmentQuery groupById() Group by the id column
 * @method     ChildAssignmentQuery groupByName() Group by the name column
 * @method     ChildAssignmentQuery groupByTeacherId() Group by the teacher_id column
 * @method     ChildAssignmentQuery groupByStartDate() Group by the start_date column
 * @method     ChildAssignmentQuery groupByHours() Group by the hours column
 *
 * @method     ChildAssignmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAssignmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAssignmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAssignmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAssignmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAssignmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAssignmentQuery leftJoinTeacher($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teacher relation
 * @method     ChildAssignmentQuery rightJoinTeacher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teacher relation
 * @method     ChildAssignmentQuery innerJoinTeacher($relationAlias = null) Adds a INNER JOIN clause to the query using the Teacher relation
 *
 * @method     ChildAssignmentQuery joinWithTeacher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teacher relation
 *
 * @method     ChildAssignmentQuery leftJoinWithTeacher() Adds a LEFT JOIN clause and with to the query using the Teacher relation
 * @method     ChildAssignmentQuery rightJoinWithTeacher() Adds a RIGHT JOIN clause and with to the query using the Teacher relation
 * @method     ChildAssignmentQuery innerJoinWithTeacher() Adds a INNER JOIN clause and with to the query using the Teacher relation
 *
 * @method     \API\Model\TeacherQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAssignment findOne(ConnectionInterface $con = null) Return the first ChildAssignment matching the query
 * @method     ChildAssignment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAssignment matching the query, or a new ChildAssignment object populated from the query conditions when no match is found
 *
 * @method     ChildAssignment findOneById(int $id) Return the first ChildAssignment filtered by the id column
 * @method     ChildAssignment findOneByName(string $name) Return the first ChildAssignment filtered by the name column
 * @method     ChildAssignment findOneByTeacherId(int $teacher_id) Return the first ChildAssignment filtered by the teacher_id column
 * @method     ChildAssignment findOneByStartDate(string $start_date) Return the first ChildAssignment filtered by the start_date column
 * @method     ChildAssignment findOneByHours(int $hours) Return the first ChildAssignment filtered by the hours column *

 * @method     ChildAssignment requirePk($key, ConnectionInterface $con = null) Return the ChildAssignment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignment requireOne(ConnectionInterface $con = null) Return the first ChildAssignment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignment requireOneById(int $id) Return the first ChildAssignment filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignment requireOneByName(string $name) Return the first ChildAssignment filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignment requireOneByTeacherId(int $teacher_id) Return the first ChildAssignment filtered by the teacher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignment requireOneByStartDate(string $start_date) Return the first ChildAssignment filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignment requireOneByHours(int $hours) Return the first ChildAssignment filtered by the hours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAssignment objects based on current ModelCriteria
 * @method     ChildAssignment[]|ObjectCollection findById(int $id) Return ChildAssignment objects filtered by the id column
 * @method     ChildAssignment[]|ObjectCollection findByName(string $name) Return ChildAssignment objects filtered by the name column
 * @method     ChildAssignment[]|ObjectCollection findByTeacherId(int $teacher_id) Return ChildAssignment objects filtered by the teacher_id column
 * @method     ChildAssignment[]|ObjectCollection findByStartDate(string $start_date) Return ChildAssignment objects filtered by the start_date column
 * @method     ChildAssignment[]|ObjectCollection findByHours(int $hours) Return ChildAssignment objects filtered by the hours column
 * @method     ChildAssignment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AssignmentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \API\Model\Base\AssignmentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\API\\Model\\Assignment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAssignmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAssignmentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAssignmentQuery) {
            return $criteria;
        }
        $query = new ChildAssignmentQuery();
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
     * @return ChildAssignment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AssignmentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AssignmentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAssignment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, teacher_id, start_date, hours FROM assignment WHERE id = :p0';
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
            /** @var ChildAssignment $obj */
            $obj = new ChildAssignment();
            $obj->hydrate($row);
            AssignmentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAssignment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AssignmentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AssignmentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignmentTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignmentTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the teacher_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTeacherId(1234); // WHERE teacher_id = 1234
     * $query->filterByTeacherId(array(12, 34)); // WHERE teacher_id IN (12, 34)
     * $query->filterByTeacherId(array('min' => 12)); // WHERE teacher_id > 12
     * </code>
     *
     * @see       filterByTeacher()
     *
     * @param     mixed $teacherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByTeacherId($teacherId = null, $comparison = null)
    {
        if (is_array($teacherId)) {
            $useMinMax = false;
            if (isset($teacherId['min'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_TEACHER_ID, $teacherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($teacherId['max'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_TEACHER_ID, $teacherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignmentTableMap::COL_TEACHER_ID, $teacherId, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignmentTableMap::COL_START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the hours column
     *
     * Example usage:
     * <code>
     * $query->filterByHours(1234); // WHERE hours = 1234
     * $query->filterByHours(array(12, 34)); // WHERE hours IN (12, 34)
     * $query->filterByHours(array('min' => 12)); // WHERE hours > 12
     * </code>
     *
     * @param     mixed $hours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByHours($hours = null, $comparison = null)
    {
        if (is_array($hours)) {
            $useMinMax = false;
            if (isset($hours['min'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_HOURS, $hours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hours['max'])) {
                $this->addUsingAlias(AssignmentTableMap::COL_HOURS, $hours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignmentTableMap::COL_HOURS, $hours, $comparison);
    }

    /**
     * Filter the query by a related \API\Model\Teacher object
     *
     * @param \API\Model\Teacher|ObjectCollection $teacher The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssignmentQuery The current query, for fluid interface
     */
    public function filterByTeacher($teacher, $comparison = null)
    {
        if ($teacher instanceof \API\Model\Teacher) {
            return $this
                ->addUsingAlias(AssignmentTableMap::COL_TEACHER_ID, $teacher->getId(), $comparison);
        } elseif ($teacher instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssignmentTableMap::COL_TEACHER_ID, $teacher->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTeacher() only accepts arguments of type \API\Model\Teacher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teacher relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function joinTeacher($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teacher');

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
            $this->addJoinObject($join, 'Teacher');
        }

        return $this;
    }

    /**
     * Use the Teacher relation Teacher object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \API\Model\TeacherQuery A secondary query class using the current class as primary query
     */
    public function useTeacherQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTeacher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teacher', '\API\Model\TeacherQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAssignment $assignment Object to remove from the list of results
     *
     * @return $this|ChildAssignmentQuery The current query, for fluid interface
     */
    public function prune($assignment = null)
    {
        if ($assignment) {
            $this->addUsingAlias(AssignmentTableMap::COL_ID, $assignment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the assignment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssignmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AssignmentTableMap::clearInstancePool();
            AssignmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AssignmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AssignmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AssignmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AssignmentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AssignmentQuery
