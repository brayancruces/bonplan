<?php

namespace Bonplan\Helper;

class DateHelper
{
  /**
   * @var DateTime
   */
  protected $date;

  /**
   * @var array
   */
  private $days = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');

  /**
   * @var array
   */
  private $months = array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');

  /**
   * Constructor
   *
   * @param DateTime $date
   * @return void
   */
  public function __construct(\DateTime $date)
  {
    $this->date = $date;
  }

  /**
   * Returns the full date in french
   *
   * @return string
   */
  public function getFullDate()
  {
    return sprintf('Le %s %d %s %d', $this->days[$this->date->format('w')], $this->date->format('d'), $this->months[$this->date->format('n') - 1], $this->date->format('Y'));
  }
}