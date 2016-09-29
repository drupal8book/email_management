<?php

namespace Drupal\email_management\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EmailProviderForm.
 *
 * @package Drupal\email_management\Form
 */
class EmailProviderForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $email_provider = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $email_provider->label(),
      '#description' => $this->t("Label for the Email provider."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $email_provider->id(),
      '#machine_name' => [
        'exists' => '\Drupal\email_management\Entity\EmailProvider::load',
      ],
      '#disabled' => !$email_provider->isNew(),
    ];

    $form['domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Domain Name'),
      '#maxlength' => 255,
      '#default_value' => $email_provider->domain(),
      '#description' => $this->t("Domain name which you use to send your e-mails."),
      '#required' => FALSE,
    ];

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#maxlength' => 255,
      '#default_value' => $email_provider->api_key(),
      '#description' => $this->t("API key of the Email provider."),
      '#required' => FALSE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $email_provider = $this->entity;
    $status = $email_provider->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Email provider.', [
          '%label' => $email_provider->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Email provider.', [
          '%label' => $email_provider->label(),
        ]));
    }
    $form_state->setRedirectUrl($email_provider->urlInfo('collection'));
  }

}
