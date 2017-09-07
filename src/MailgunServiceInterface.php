<?php

namespace Drupal\email_management;

/**
 * Interface MailServiceInterface.
 *
 * @package Drupal\email_management
 */
interface MailServiceInterface {
  public function send($message);
}
