<?php

namespace Bonplan\Service;

use Doctrine\DBAL\Connection;

use Bonplan\Entity\Bonplan;

/**
 * @todo delete
 */
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

  /**
   * Persist a new bon plan in bdd
   *
   * @return boolean
   * @see Statement::execute()
   */
  public function create(Bonplan $bonplan)
  {
    $sql = "INSERT INTO bonplan (date, lieu, description) VALUES (?,?,?)";
    return $this->connection->executeQuery($sql, array($bonplan->getDate(), $bonplan->getLieu(), $bonplan->getDescription()));
  }

  /**
   * Retrieve one object by id
   *
   * @param integer $id
   * @return Bonplan\Entity\Bonplan
   * @throws InvalidArgumentException
   */
  public function readOne($id)
  {
    $sql = "SELECT * FROM bonplan WHERE id = ?";
    $data = $this->connection->fetchAssoc($sql, array((int) $id));

    if (!$data)
    {
      throw new \InvalidArgumentException("Unknown id");
    }

    return Bonplan::fromArray($data);
  }
}