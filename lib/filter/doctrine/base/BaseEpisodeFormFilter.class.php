<?php

/**
 * Episode filter form base class.
 *
 * @package    serialkiller
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEpisodeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'season'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'episode' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'serie'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Serie'), 'add_empty' => true)),
      'date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'season'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'episode' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'    => new sfValidatorPass(array('required' => false)),
      'serie'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Serie'), 'column' => 'id')),
      'date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('episode_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Episode';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'season'  => 'Number',
      'episode' => 'Number',
      'name'    => 'Text',
      'serie'   => 'ForeignKey',
      'date'    => 'Date',
    );
  }
}
