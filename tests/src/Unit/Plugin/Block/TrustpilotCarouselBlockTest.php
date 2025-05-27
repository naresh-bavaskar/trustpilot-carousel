<?php

namespace Drupal\Tests\trustpilot_carousel\Unit\Plugin\Block;

use Drupal\trustpilot_carousel\Plugin\Block\TrustpilotCarouselBlock;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;
use Drupal\Core\Url;

/**
 * @coversDefaultClass \Drupal\trustpilot_carousel\Unit
 * @group trustpilot_carousel
 */
class TrustpilotCarouselBlockTest extends UnitTestCase {

  /**
   * Tests caching in TrustpilotCarouselBlock.
   */
  public function testBuildArrayHasCacheMetadata(): void {
    $httpClient = $this->createMock(ClientInterface::class);
    $definition = ['provider' => 'trustpilot_carousel'];
    // Instantiate the block plugin.
    $block = new TrustpilotCarouselBlock([], 'trustpilot_carousel', $definition, $httpClient);

    $block->setConfiguration(['review_count' => 6]);

    // Build the block.
    $build = $block->build();
    // Assertions for cache.
    $this->assertArrayHasKey('#cache', $build);
    $this->assertEquals(['trustpilot_reviews_data'], $build['#cache']['tags']);
    $this->assertEquals(3600, $build['#cache']['max-age']);
  }

}
