<?php

namespace Drupal\email_management\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EmailProviderSettingsForm.
 *
 * @package Drupal\email_management\Form
 */
class EmailProviderSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'email_management.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'email_provider_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('email_management.settings');
    $form['email_provider'] = [
      '#type' => 'select',
      '#title' => $this->t('Email Provider'),
      '#description' => $this->t('Select the default email service provider'),
      '#options' => $this->getProviders(),
      '#default_value' => $config->get('email_provider'),
    ];
    return parent::buildForm($form, $form_state);
  }

  private function getProviders() {
    $email_providers = [];
    $provider_ids = \Drupal::entityQuery('email_provider')->execute();
    $providers = entity_load_multiple('email_provider', $provider_ids);
    foreach($providers as $provider) {
      $email_providers[$provider->id()] = $provider->label();
    }
    return $email_providers;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('email_management.settings')
      ->set('email_provider', $form_state->getValue('email_provider'))
      ->save();
  }

}
