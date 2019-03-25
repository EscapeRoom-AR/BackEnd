<?php

namespace API\Model\Map;

use API\Model\Game;
use API\Model\GameQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'game' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class GameTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'API.Model.Map.GameTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'game';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\API\\Model\\Game';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'API.Model.Game';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'game.created';

    /**
     * the column name for the deleted field
     */
    const COL_DELETED = 'game.deleted';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'game.code';

    /**
     * the column name for the hints_used field
     */
    const COL_HINTS_USED = 'game.hints_used';

    /**
     * the column name for the time field
     */
    const COL_TIME = 'game.time';

    /**
     * the column name for the user_code field
     */
    const COL_USER_CODE = 'game.user_code';

    /**
     * the column name for the room_code field
     */
    const COL_ROOM_CODE = 'game.room_code';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Created', 'Deleted', 'Code', 'HintsUsed', 'Time', 'UserCode', 'RoomCode', ),
        self::TYPE_CAMELNAME     => array('created', 'deleted', 'code', 'hintsUsed', 'time', 'userCode', 'roomCode', ),
        self::TYPE_COLNAME       => array(GameTableMap::COL_CREATED, GameTableMap::COL_DELETED, GameTableMap::COL_CODE, GameTableMap::COL_HINTS_USED, GameTableMap::COL_TIME, GameTableMap::COL_USER_CODE, GameTableMap::COL_ROOM_CODE, ),
        self::TYPE_FIELDNAME     => array('created', 'deleted', 'code', 'hints_used', 'time', 'user_code', 'room_code', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Created' => 0, 'Deleted' => 1, 'Code' => 2, 'HintsUsed' => 3, 'Time' => 4, 'UserCode' => 5, 'RoomCode' => 6, ),
        self::TYPE_CAMELNAME     => array('created' => 0, 'deleted' => 1, 'code' => 2, 'hintsUsed' => 3, 'time' => 4, 'userCode' => 5, 'roomCode' => 6, ),
        self::TYPE_COLNAME       => array(GameTableMap::COL_CREATED => 0, GameTableMap::COL_DELETED => 1, GameTableMap::COL_CODE => 2, GameTableMap::COL_HINTS_USED => 3, GameTableMap::COL_TIME => 4, GameTableMap::COL_USER_CODE => 5, GameTableMap::COL_ROOM_CODE => 6, ),
        self::TYPE_FIELDNAME     => array('created' => 0, 'deleted' => 1, 'code' => 2, 'hints_used' => 3, 'time' => 4, 'user_code' => 5, 'room_code' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('game');
        $this->setPhpName('Game');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\API\\Model\\Game');
        $this->setPackage('API.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, null);
        $this->addColumn('deleted', 'Deleted', 'TIMESTAMP', false, null, null);
        $this->addPrimaryKey('code', 'Code', 'INTEGER', true, null, null);
        $this->addColumn('hints_used', 'HintsUsed', 'INTEGER', true, null, 0);
        $this->addColumn('time', 'Time', 'INTEGER', true, null, null);
        $this->addForeignKey('user_code', 'UserCode', 'INTEGER', 'user', 'code', true, null, null);
        $this->addForeignKey('room_code', 'RoomCode', 'INTEGER', 'room', 'code', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\API\\Model\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_code',
    1 => ':code',
  ),
), null, null, null, false);
        $this->addRelation('Room', '\\API\\Model\\Room', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':room_code',
    1 => ':code',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? GameTableMap::CLASS_DEFAULT : GameTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Game object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = GameTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GameTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GameTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GameTableMap::OM_CLASS;
            /** @var Game $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GameTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = GameTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GameTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Game $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GameTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(GameTableMap::COL_CREATED);
            $criteria->addSelectColumn(GameTableMap::COL_DELETED);
            $criteria->addSelectColumn(GameTableMap::COL_CODE);
            $criteria->addSelectColumn(GameTableMap::COL_HINTS_USED);
            $criteria->addSelectColumn(GameTableMap::COL_TIME);
            $criteria->addSelectColumn(GameTableMap::COL_USER_CODE);
            $criteria->addSelectColumn(GameTableMap::COL_ROOM_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.deleted');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.hints_used');
            $criteria->addSelectColumn($alias . '.time');
            $criteria->addSelectColumn($alias . '.user_code');
            $criteria->addSelectColumn($alias . '.room_code');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(GameTableMap::DATABASE_NAME)->getTable(GameTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(GameTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(GameTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new GameTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Game or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Game object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \API\Model\Game) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GameTableMap::DATABASE_NAME);
            $criteria->add(GameTableMap::COL_CODE, (array) $values, Criteria::IN);
        }

        $query = GameQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GameTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GameTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the game table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return GameQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Game or Criteria object.
     *
     * @param mixed               $criteria Criteria or Game object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Game object
        }

        if ($criteria->containsKey(GameTableMap::COL_CODE) && $criteria->keyContainsValue(GameTableMap::COL_CODE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GameTableMap::COL_CODE.')');
        }


        // Set the correct dbName
        $query = GameQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // GameTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
GameTableMap::buildTableMap();
