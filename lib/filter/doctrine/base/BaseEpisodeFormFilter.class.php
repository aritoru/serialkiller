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
      'show'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Serie'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'season'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'episode' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'    => new sfValidatorPass(array('required' => false)),
      'show'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Serie'), 'column' => 'id')),
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
      'show'    => 'ForeignKey',
    );
  }
}
