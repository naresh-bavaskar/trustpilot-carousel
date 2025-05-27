<?php

namespace Drupal\Tests\trustpilot_carousel\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\trustpilot_carousel\Controller\MockReviewsController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @coversDefaultClass \Drupal\trustpilot_carousel\Unit
 * @group trustpilot_carousel
 */
class MockReviewsControllerTest extends UnitTestCase {

  /**
   * Test the structure of the JSON response from MockReviewsController.
   */
  public function testJsonResponseStructure() {
    $controller = new MockReviewsController();
    $response = $controller->getReviews();

    // print('<pre>');print_r($response);print('</pre>');exit;
    $this->assertInstanceOf(JsonResponse::class, $response);

    $data = json_decode($response->getContent(), TRUE);
    $this->assertIsArray($data);
    $this->assertArrayHasKey('reviews', $data);
    $review = $data['reviews'][0];
    $this->assertArrayHasKey('author', $review);
    $this->assertArrayHasKey('rating', $review);
    $this->assertArrayHasKey('title', $review);
    $this->assertArrayHasKey('content', $review);
    $this->assertArrayHasKey('date', $review);
  }

}
