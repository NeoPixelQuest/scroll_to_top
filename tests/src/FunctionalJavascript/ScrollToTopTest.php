<?php

namespace Drupal\Tests\scroll_to_top\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Class ScrollToTopTest. The base class for testing scroll to top.
 */
class ScrollToTopTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['scroll_to_top'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Test scroll to top element.
   */
  public function testScrollToTop() {
    // Log in as an admin user with permission to manage module settings.
    $admin = $this->drupalCreateUser([], NULL, TRUE);
    $this->drupalLogin($admin);

    // Add scroll to top configs.
    $this->drupalGet('/admin/config/user-interface/scrolltotop');

    $edit = [
      'scroll_to_top_enable_admin_theme' => TRUE,
    ];
    $this->submitForm($edit, 'Save configuration');
    $this->assertSession()->pageTextContains('The configuration options have been saved.');

    $this->drupalGet('/admin');
    $this->assertSession()->waitForElementVisible('css', '#back-top #link');
    $this->assertSession()->elementExists('css', '#back-top #link');
  }

}
