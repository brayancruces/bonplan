<?php

namespace Bonplan\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\DBAL\Connection;

use Bonplan\Helper\DateHelper;

class Bonplan implements BonplanCrudInterface
{
  /**
   * @var string
   */
  private static $tableName = 'bonplan';

  /**
   * @var integer
   */
  protected $id;

  /**
   * @var string
   */
  protected $date;

  /**
   * @var string
   */
  protected $lieu;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var DateTime
   */
  protected $created_at;

  /**
   * @var DateTime
   */
  protected $updated_at;

  public function __construct() {}

  /** Getters **/

  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getDate()
  {
    return $this->date;
  }

  public function getFullDate()
  {
    $helper = new DateHelper(new \DateTime($this->date));
    return $helper->getFullDate();
  }

  /**
   * @return string
   */
  public function getLieu()
  {
    return $this->lieu;
  }

  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @return DateTime
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * @return DateTime
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /** Setters **/

  /**
   * @return BonPlan
   */
  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  /**
   * @return BonPlan
   */
  public function setLieu($lieu)
  {
    $this->lieu = $lieu;

    return $this;
  }

  /**
   * @return BonPlan
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /** Business part **/

  /** Herited from crud interface **/

  /**
   * @see BonplanCrudInterface::readOne()
   * @return Bonplan\Entity\Bonplan
   */
  static public function readOne(array $primaryKey, Connection $connection)
  {
    if (!count($primaryKey))
    {
      throw new \InvalidArgumentException("Primary key can't be empty");
    }

    $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE ';

    foreach (array_keys($primaryKey) as $key)
    {
      $sql .= $key . ' = ?';
    }

    $return = $connection->fetchAssoc($sql, array_values($primaryKey));

    if (!$return)
    {
      throw new \UnexpectedValueException("The resource cant't be found");
    }

    return self::fromArray($return);
  }

  /**
   * @see BonplanCrudInterface::create()
   */
  public function create(Connection $connection)
  {
    $nbInsert = $connection->insert(self::$tableName, array(
      'date'        => $this->date,
      'lieu'        => $this->lieu,
      'description' => $this->description
    ));

    return $nbInsert === 1 ? true : false;
  }

  /**
   * Returns the table name
   *
   * @return string
   */
  static public function getTableName()
  {
    return self::$tableName;
  }

  /** Herited from interface **/

  /**
   * Fill a new bonplan instance with data
   *
   * @param array $data Associative array
   * @return Bonplan\Entity\Bonplan
   */
  static public function fromArray($data)
  {
    $bonplan = new Bonplan;

    foreach ($data as $key => $value)
    {
      $bonplan->$key = $value;
    }

    return $bonplan;
  }

  static public function loadValidatorMetadata(ClassMetadata $metadata)
  {
    $metadata->addPropertyConstraint('date', new Assert\Date());

    $metadata->addPropertyConstraint('lieu', new Assert\NotBlank());
    $metadata->addPropertyConstraint('lieu', new Assert\MinLength(5));

    $metadata->addPropertyConstraint('description', new Assert\NotBlank());
    $metadata->addPropertyConstraint('description', new Assert\MinLength(20));
  }
}