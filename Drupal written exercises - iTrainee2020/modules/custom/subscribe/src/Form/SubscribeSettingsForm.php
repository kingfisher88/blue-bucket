<?php

namespace Drupal\subscribe\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SubscribeSettingsForm.
 */
class SubscribeSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['subscribe.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'subscribe_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('subscribe.settings');

    $form['to'] = [
      '#type' => 'email',
      '#title' => $this->t('To'),
      '#default_value' => $config->get('to'),
    ];

    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#size' => 60,
      '#default_value' => $config->get('subject'),
    ];

    $form['body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#default_value' => $config->get('body'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('subscribe.settings')
      ->set('to', $form_state->getValue('to'))
      ->set('subject', $form_state->getValue('subject'))
      ->set('body', $form_state->getValue('body'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
