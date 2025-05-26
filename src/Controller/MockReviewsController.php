<?php

namespace Drupal\trustpilot_carousel\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 */
class MockReviewsController {

  /**
   *
   */
  public function getReviews() {
    $data = [
      'reviews' => [
        [
          'author' => 'John Doe',
          'rating' => 5,
          'title' => 'Excellent service!',
          'content' => 'Great experience, highly recommended.',
          'date' => '2024-03-18',
        ],
        [
          'author' => 'Jane Smith',
          'rating' => 4,
          'title' => 'Very good!',
          'content' => 'Satisfied with the product.',
          'date' => '2024-04-10',
        ],
        [
          'author' => 'Mike Johnson',
          'rating' => 3,
          'title' => 'Average',
          'content' => 'It was okay, expected more.',
          'date' => '2024-05-01',
        ],
        [
          'author' => 'Anita Desai',
          'rating' => 5,
          'title' => 'Fantastic!',
          'content' => 'Everything was perfect from start to finish.',
          'date' => '2024-05-05',
        ],
        [
          'author' => 'Carlos Ramirez',
          'rating' => 2,
          'title' => 'Not satisfied',
          'content' => 'Had issues with delivery and support.',
          'date' => '2024-05-10',
        ],
        [
          'author' => 'Emily Wang',
          'rating' => 4,
          'title' => 'Great support',
          'content' => 'Customer support team was very helpful.',
          'date' => '2024-05-12',
        ],
        [
          'author' => 'Raj Patel',
          'rating' => 5,
          'title' => 'Loved it!',
          'content' => 'Will definitely buy again.',
          'date' => '2024-05-14',
        ],
        [
          'author' => 'Sarah Lee',
          'rating' => 3,
          'title' => 'Just okay',
          'content' => 'Not bad, but could be better.',
          'date' => '2024-05-15',
        ],
        [
          'author' => 'Mohammed Ali',
          'rating' => 1,
          'title' => 'Terrible experience',
          'content' => 'Completely disappointed, won’t recommend.',
          'date' => '2024-05-16',
        ],
        [
          'author' => 'Olivia Brown',
          'rating' => 5,
          'title' => 'Best decision ever!',
          'content' => 'High quality and fast delivery.',
          'date' => '2024-05-18',
        ],
      ],
    ];

    return new JsonResponse($data);
  }

}
