<?php

namespace Bonplan\Services;

use Doctrine\DBAL\Connection;

use Bonplan\Entity\Bonplan;

class BonplanPersisterService
{
  /**
   * @var Connection $conection
   */
  private $connection;

  public function __construct(Connection $conection)
  {
    $this->connection = $conection;
  }

  public function create(Bonplan $bonplan)
  {
    $sql = "INSERT INTO bonplan (date, lieu, description) VALUES (?,?,?)";
    $this->connection->executeQuery($sql, array($bonplan->getDate(), $bonplan->getLieu(), $bonplan->getDescription()));
  }
}