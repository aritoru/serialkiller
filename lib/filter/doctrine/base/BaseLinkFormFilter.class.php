<?php

/**
 * Link filter form base class.
 *
 * @package    serialkiller
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLinkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'url'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'episode' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Episode'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'url'     => new sfValidatorPass(array('required' => false)),
      'episode' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Episode'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('link_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Link';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'url'     => 'Text',
      'episode' => 'ForeignKey',
    );
  }
}
