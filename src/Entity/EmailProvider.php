<?php

namespace Drupal\email_management\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Email provider entity.
 *
 * @ConfigEntityType(
 *   id = "email_provider",
 *   label = @Translation("Email provider"),
 *   handlers = {
 *     "list_builder" = "Drupal\email_management\EmailProviderListBuilder",
 *     "form" = {
 *       "add" = "Drupal\email_management\Form\EmailProviderForm",
 *       "edit" = "Drupal\email_management\Form\EmailProviderForm",
 *       "delete" = "Drupal\email_management\Form\EmailProviderDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\email_management\EmailProviderHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "email_provider",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/email_provider/{email_provider}",
 *     "add-form" = "/admin/structure/email_provider/add",
 *     "edit-form" = "/admin/structure/email_provider/{email_provider}/edit",
 *     "delete-form" = "/admin/structure/email_provider/{email_provider}/delete",
 *     "collection" = "/admin/structure/email_provider"
 *   }
 * )
 */
class EmailProvider extends ConfigEntityBase implements EmailProviderInterface {

  /**
   * The Email provider ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Email provider label.
   *
   * @var string
   */
  protected $label;

 /**
   * The Email provider domain.
   *
   * @var string
   */
  protected $domain;

  /**
   * The Email provider API key.
   *
   * @var string
   */
  protected $api_key;

  /**
   * {@inheritdoc}
   */
  public function domain() {
    return $this->domain;
  }

  /**
   * {@inheritdoc}
   */
  public function api_key() {
    return $this->api_key;
  }
}
