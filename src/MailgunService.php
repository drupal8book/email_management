<?php

namespace Drupal\email_management;

use Drupal\Core\Config\ConfigFactoryInterface;
use Mailgun\Mailgun;

/**
 * Class MailgunService.
 *
 * @package Drupal\email_management
 */
class MailgunService implements MailServiceInterface {

  /**
   * The Config Factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $config;

  private $mailgun;

  private $domain;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $mail_provider_id = $this->config->get('email_management.settings.email_provider');
    $mail_provider = entity_load('email_provider', $mail_provider_id);
    $this->mailgun = new Mailgun($mail_provider->api_key());
    $this->domain = $mail_provider->domain();
  }

  public function send($message) {
    $this->mailgun->sendMessage($this->domain, $message);
  }
}
