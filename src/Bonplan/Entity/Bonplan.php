<?php

namespace Bonplan\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Bonplan
{
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

  public function __construct() {}

  /** Getters **/

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

  static public function loadValidatorMetadata(ClassMetadata $metadata)
  {
    $metadata->addPropertyConstraint('date', new Assert\NotBlank());
    $metadata->addPropertyConstraint('date', new Assert\Date());

    $metadata->addPropertyConstraint('lieu', new Assert\NotBlank());
    $metadata->addPropertyConstraint('lieu', new Assert\MinLength(5));

    $metadata->addPropertyConstraint('description', new Assert\NotBlank());
    $metadata->addPropertyConstraint('description', new Assert\MinLength(20));
  }
}