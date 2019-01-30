<?php

namespace API\Model;

use API\Model\Base\Teacher as BaseTeacher;

/**
 * Skeleton subclass for representing a row from the 'teacher' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Teacher extends BaseTeacher
{

  public function getAssignmentCount() {
    return $this->getAssignments()->count();
  }

  public function getTotalHours() {
    return \API\Model\AssignmentQuery::create()->filterByTeacher($this)->withColumn('SUM(hours)', 'total')->select('total')->findOne();
  }

}
