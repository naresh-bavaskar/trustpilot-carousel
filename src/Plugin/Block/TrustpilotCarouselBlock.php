<?php

namespace Drupal\trustpilot_carousel\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Trustpilot Carousel' block.
 *
 * @Block(
 *   id = "trustpilot_carousel",
 *   admin_label = @Translation("Trustpilot Carousel"),
 *   category = @Translation("Custom"),
 * )
 */
class TrustpilotCarouselBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * The HTTP client service.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Constructs a new TrustpilotCarouselBlock instance.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ClientInterface $http_client) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->httpClient = $http_client;
  }

  /**
   * Creates an instance of the block.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('http_client')
    );
  }

  /**
   * Provides default configuration for the block.
   */
  public function defaultConfiguration() {
    return [
      'review_count' => 6,
    ];
  }

  /**
   * Provides the form for configuring the block.
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['review_count'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of reviews to display'),
      '#default_value' => $this->configuration['review_count'],
      '#min' => 3,
      '#max' => 20,
    ];
    return $form;
  }

  /**
   * Handles the submission of the block configuration form.
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['review_count'] = $form_state->getValue('review_count');
  }

  /**
   * Fetches reviews from the Trustpilot API endpoint and renders them.
   */
  public function build() {
    $review_count = (int) $this->configuration['review_count'];

    try {
      $url = Url::fromRoute('trustpilot_carousel.endpoint', [], ['absolute' => TRUE])->toString();
      $response = $this->httpClient->get($url);
      $data = json_decode($response->getBody(), TRUE);
      $reviews = array_slice($data['reviews'], 0, $review_count);
    }
    catch (\Exception $e) {
      $reviews = [];
    }

    return [
      '#theme' => 'trustpilot_reviews',
      '#reviews' => $reviews,
      '#attached' => [
        'library' => ['trustpilot_carousel/trustpilot_carousel'],
      ],
      '#cache' => [
        'tags' => ['trustpilot_reviews_data'],
      // Cache for 1 hour.
        'max-age' => 3600,
      ],
    ];
  }

}
