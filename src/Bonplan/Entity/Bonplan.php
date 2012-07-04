<?php

namespace Bonplan\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Bonplan
{
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
    $metadata->addPropertyConstraint('date', new Assert\NotBlank());

    $metadata->addPropertyConstraint('lieu', new Assert\NotBlank());
    $metadata->addPropertyConstraint('lieu', new Assert\MinLength(5));

    $metadata->addPropertyConstraint('description', new Assert\NotBlank());
    $metadata->addPropertyConstraint('description', new Assert\MinLength(20));
  }
}