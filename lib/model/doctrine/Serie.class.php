<?php

/**
 * Serie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    serialkiller
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Serie extends BaseSerie
{
  
  public static function getSerieByName($name)
  {
    $serie = SerieTable::getInstance()
        ->findOneByName($name);
    
    if ($serie == null) {
      $newSerie = new Serie();
      $newSerie->name = $name;
      $newSerie->save();
      return $newSerie; 
    } else {
      return $serie;
    }
  }

  
}
