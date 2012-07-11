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
  protected $titre;

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
   * @var float
   */
  protected $prix;

  /**
   * @var string
   */
  protected $auteur;

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
  public function getTitre()
  {
    return $this->titre;
  }

  /**
   * @return string
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @see DateHelper::getFullDate()
   */
  public function getFullDate()
  {
    $helper = new DateHelper(new \DateTime($this->date));
    return $helper->getFullDate();
  }

  /**
   * @see DateHelper::getSmallDate()
   */
  public function getSmallDate()
  {
    $helper = new DateHelper(new \DateTime($this->date));
    return $helper->getSmallDate();
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
   * @return float
   */
  public function getPrix()
  {
    return $this->prix;
  }

  /**
   * @return string
   */
  public function getAuteur()
  {
    return $this->auteur;
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
   * @param string
   * @return Bonplan
   */
  public function setTitre($titre)
  {
    $this->titre = $titre;

    return $this;
  }

  /**
   * @param string
   * @return Bonplan
   */
  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  /**
   * @param string
   * @return Bonplan
   */
  public function setLieu($lieu)
  {
    $this->lieu = $lieu;

    return $this;
  }

  /**
   * @param string
   * @return Bonplan
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * @param float
   * @return Bonplan
   */
  public function setPrix($prix)
  {
    $this->prix = $prix;

    return $this;
  }

  /**
   * @param string
   * @return Bonplan
   */
  public function setAuteur($auteur)
  {
    $this->auteur = $auteur;

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
    $values = array();

    $values['titre'] = $this->titre;
    if (strlen($this->date)) $values['date'] = $this->date;
    $values['lieu'] = $this->lieu;
    $values['description'] = $this->description;
    if (!is_null($this->prix)) $values['prix'] = $this->prix;
    if (!is_null($this->auteur)) $values['auteur'] = $this->auteur;

    return $connection->insert(self::$tableName, $values) === 1 ? true : false;
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
   * Get all bonplan for this day
   *
   * @param Connection $connection
   * @return array
   */
  static public function readForToday(Connection $connection)
  {
    $today = new \DateTime;

    $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE (date >= ? AND date <= ?) OR date IS NULL';

    $results = $connection->fetchAll($sql, array($today->format('Y-m-d'), $today->format('Y-m-d')));

    $bonplans = array();

    foreach ($results as $result)
    {
      $bonplans[] = self::fromArray($result);
    }

    return $bonplans;
  }

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
    $metadata->addPropertyConstraint('titre', new Assert\NotBlank());
    $metadata->addPropertyConstraint('titre', new Assert\MinLength(5));

    $metadata->addPropertyConstraint('date', new Assert\Date());

    $metadata->addPropertyConstraint('lieu', new Assert\NotBlank());
    $metadata->addPropertyConstraint('lieu', new Assert\MinLength(5));

    $metadata->addPropertyConstraint('description', new Assert\NotBlank());
    $metadata->addPropertyConstraint('description', new Assert\MinLength(20));

    $metadata->addPropertyConstraint('prix', new Assert\Regex('/^\d+(\.\d{1,2})?$/'));
    $metadata->addPropertyConstraint('prix', new Assert\Max(9999));
    $metadata->addPropertyConstraint('prix', new Assert\Min(0));

    $metadata->addPropertyConstraint('auteur', new Assert\MinLength(2));
    $metadata->addPropertyConstraint('auteur', new Assert\MaxLength(20));
  }
}