<?php

namespace Drupal\Tests\trustpilot_carousel\Kernel\Plugin\Block;

use Drupal\KernelTests\KernelTestBase;

/**
 * Kernel test for TrustpilotCarouselBlock.
 *
 * @group trustpilot_carousel
 */
class TrustpilotCarouselBlockKernelTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'trustpilot_carousel',
  ];

  /**
   * The block plugin under test.
   *
   * @var \Drupal\trustpilot_carousel\Plugin\Block\TrustpilotCarouselBlock
   */
  protected $block;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->block_manager = $this->container->get('plugin.manager.block');

  }

  /**
   * Test block render output.
   */
  public function testBlockRenderingWithSixReviews(): void {

    /** @var \Drupal\Core\Block\BlockManagerInterface $block_manager */
    $review_count = 6;
    /** @var \Drupal\Core\Block\BlockPluginInterface $plugin_block */
    $plugin_block = $this->block_manager->createInstance('trustpilot_carousel', [
      'review_count' => $review_count,
    ]);

    $render_array = $plugin_block->build();

    $this->assertArrayHasKey('#reviews', $render_array);
    $this->assertCount($review_count, $render_array['#reviews'], 'Expected number of reviews returned.');
    $this->assertEquals(['trustpilot_reviews_data'], $render_array['#cache']['tags']);
    $this->assertEquals(3600, $render_array['#cache']['max-age']);
  }

  /**
   * Tests block render output for review_count = 3.
   */
  public function testBlockRenderingWithThreeReviews(): void {
    $review_count = 3;
    $plugin_block = $this->block_manager->createInstance('trustpilot_carousel', [
      'review_count' => $review_count,
    ]);
    $render_array = $plugin_block->build();

    $this->assertArrayHasKey('#reviews', $render_array);
    $this->assertCount($review_count, $render_array['#reviews'], 'Expected 3 reviews.');
    $this->assertEquals(['trustpilot_reviews_data'], $render_array['#cache']['tags']);
    $this->assertEquals(3600, $render_array['#cache']['max-age']);
  }

}
