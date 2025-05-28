## Trustpilot Carousel - Installation Guide

### **Prerequisites**

* Drupal 10 or later installed via Composer.
* The `drupal/core-dev` package included (required for PHPUnit compatibility).

---

### **Installation Steps**

1. **Place the Module**
   Copy the `trustpilot_carousel` module into your Drupal project's `modules/custom` directory.

2. **Enable the Module**
   Enable it using either:

   * Drush:

     ```bash
     drush en trustpilot_carousel
     ```
   * Admin UI:
     Navigate to **Extend** and enable **Trustpilot Carousel**.

3. **Add the Carousel Block**

   * Go to: **Structure → Block layout**.
   * Place the **Trustpilot Carousel** block in your desired region.

4. **Configure Number of Reviews**

   * When placing the block, specify the number of reviews you want to display in the carousel.

5. **Manually Clear the Cache (Optional)**

   * Navigate to: **Configuration → Clear Trustpilot Carousel Cache**.
   * Click the **"Clear cache"** button.
   * (Note: Cache is set to expire automatically every 1 hour.)

---

### ** PHPUnit Test Cases**

* Automated tests for:

  * Mock API responses
  * Caching logic
  * Configuration validation

* Test files are located in the module's `tests` directory.

---

Let me know if you'd like it in a `README.md` format or need help writing test coverage examples.
