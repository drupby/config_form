<?php

/**
 * @file
 * Contains Drupal\config_form\Form\ConfigForm.
 */

namespace Drupal\config_form\Form;

use Drupal\Core\Form\ConfigFormBase;

/**
 * Social comments config form.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'social_configure';
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('config_form.settings');

    $form = array();

    $form['config_form'] = array(
      '#type' => 'fieldset',
      '#title' => t('Settings'),
    );

    $form['config_form']['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#description' => t('Enter your name'),
      '#default_value' => $config->get('name'),
    );
    $form['config_form']['surname'] = array(
      '#type' => 'textfield',
      '#title' => t('Surname'),
      '#description' => t(
        'Enter your surname !link',
        array(
          '!link' => l(
            t('Surname'),
            'http://en.wikipedia.org/wiki/Surname',
            array(
              'attributes' => array(
                'target' => '_blank',
              ),
            )
          ),
        )
      ),
      '#default_value' => $config->get('surname'),
    );

    $form['config_form']['option'] = array(
      '#type' => 'select',
      '#title' => $this->t('Select type'),
      '#required' => TRUE,
      '#default_value' => $config->get('option'),
      '#options' => array(
        0 => t('One'),
        1 => t('Two'),
        2 => t('Three'),
      ),
      '#weight' => -5,
    );
    

    return parent::buildForm($form, $form_state);
  }
  
  /**
   * Implements \Drupal\Core\Form\FormInterface::validateForm().
   */
  public function validateForm(array &$form, array &$form_state) { }

  /**
   * Implements \Drupal\Core\Form\FormInterface::submitForm().
   */
  public function submitForm(array &$form, array &$form_state) {
    $this->configFactory->get('config_form.settings')
      ->set('option', $form_state['values']['option'])
      ->set('name', $form_state['values']['name'])
      ->set('surname', $form_state['values']['surname'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
