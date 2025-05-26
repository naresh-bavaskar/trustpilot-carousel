<?php

namespace Drupal\trustpilot_carousel\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class TrustPilotCacheClearController extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'clear_trustpilot_cache_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    // No config to edit here, so empty array.
    return [];
  }

  /**
   * Build the config form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#markup' => $this->t('<p>Click the button below to clear the cache of the Trustpilot Carousel block.</p>'),
    ];
    $form['actions']['clear_cache'] = [
      '#type' => 'submit',
      '#value' => $this->t('Clear Trustpilot Carousel Cache'),
      '#button_type' => 'primary',
    ];

    // Return form without the default submit button.
    return $form;
  }

  /**
   * Submit handler clears cache.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Invalidate cache tag for your block.
    \Drupal::service('cache_tags.invalidator')->invalidateTags(['trustpilot_reviews_data']);

    $this->messenger()->addStatus($this->t('Trustpilot Carousel cache cleared successfully.'));

  }

}
