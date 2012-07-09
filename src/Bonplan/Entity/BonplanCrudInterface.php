<?php

namespace Bonplan\Entity;

use Doctrine\DBAL\Connection;

interface BonplanCrudInterface
{
  /**
   * Retrieve one object by primary key
   *
   * @param array $primaryKey
   * @param Connection $connection
   * @throws InvalidArgumentException, UnexpectedValueException
   */
  public static function readOne(array $primaryKey, Connection $connection);

  /**
   * Persist a new object in bdd.
   * Return true if everything went well. False otherwise
   *
   * @param Connection $connection
   * @return boolean
   */
  public function create(Connection $connection);

  /**
   * Return the table name
   *
   * @return string The table name
   */
  static public function getTableName();
}