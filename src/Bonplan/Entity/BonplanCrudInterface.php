<?php

namespace Bonplan\Entity;

use Doctrine\DBAL\Connection;

interface BonplanCrudInterface
{
  /**
   * Retrieve one object by primary key
   *
   * @param array $primaryKey
   * @throws InvalidArgumentException, UnexpectedValueException
   */
  public static function readOne(array $primaryKey, Connection $conection);
}