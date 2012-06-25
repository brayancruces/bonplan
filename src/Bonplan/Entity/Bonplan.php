<?php

namespace Bonplan\Entity;

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
}