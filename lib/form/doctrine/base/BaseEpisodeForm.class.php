<?php

/**
 * Episode form base class.
 *
 * @method Episode getObject() Returns the current form's model object
 *
 * @package    serialkiller
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEpisodeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'season'  => new sfWidgetFormInputText(),
      'episode' => new sfWidgetFormInputText(),
      'name'    => new sfWidgetFormInputText(),
      'show'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Serie'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'season'  => new sfValidatorInteger(),
      'episode' => new sfValidatorInteger(),
      'name'    => new sfValidatorString(array('max_length' => 126)),
      'show'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Serie'))),
    ));

    $this->widgetSchema->setNameFormat('episode[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Episode';
  }

}
