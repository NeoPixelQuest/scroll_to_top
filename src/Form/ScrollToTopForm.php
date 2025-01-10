<?php

namespace Drupal\scroll_to_top\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * This class exists as a mid-point between dependency injection.
 *
 * Through ContainerInjectionInterface, and a less-structured use of traits
 *   which default to using the \Drupal accessor for service discovery.
 */
class ScrollToTopForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'scroll_to_top.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'scroll_to_top_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('scroll_to_top.settings');

    $form['scroll_to_top_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#description' => $this->t('Label displayed in scroll to top link, default "Back to top".'),
      '#default_value' => $config->get('scroll_to_top_label'),
      '#size' => 10,
    ];
    $form['scroll_to_top_position'] = [
      '#title' => $this->t('Position'),
      '#description' => $this->t('Scroll to top button position.'),
      '#type' => 'select',
      '#options' => [
        1 => $this->t('right'),
        2 => $this->t('left'),
        3 => $this->t('middle'),
      ],
      '#default_value' => $config->get('scroll_to_top_position'),
    ];

    $form['scroll_to_top_bg_color_hover'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color on mouse over'),
      '#description' => $this->t('Button background color on mouse over default #006595.'),
      '#default_value' => $config->get('scroll_to_top_bg_color_hover'),
    ];
    $form['scroll_to_top_bg_color_out'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color on mouse out'),
      '#description' => $this->t('Button background color on mouse over default #CCCCCC.'),
      '#default_value' => $config->get('scroll_to_top_bg_color_out'),
    ];
    $form['scroll_to_top_display_text'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display label'),
      '#description' => $this->t('Display "BACK TO TOP" text under the button'),
      '#default_value' => $config->get('scroll_to_top_display_text'),
    ];
    $form['scroll_to_top_enable_admin_theme'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable on administration theme'),
      '#description' => $this->t('Enable scroll to top button on administration theme.'),
      '#default_value' => $config->get('scroll_to_top_enable_admin_theme'),
    ];
    $form['scroll_to_top_preview'] = [
      '#type' => 'item',
      '#title' => $this->t('Preview'),
      '#markup' => '<div id="scroll-to-top-prev-container">' . $this->t('Change a setting value to see a preview. "Position" and "enable on admin theme" not included.') . '</div>',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    // Set the values the user submitted in the form.
    $this->config('scroll_to_top.settings')
      ->set('scroll_to_top_label', $form_state->getValue('scroll_to_top_label'))
      ->set('scroll_to_top_position', (int) $form_state->getValue('scroll_to_top_position'))
      ->set('scroll_to_top_bg_color_hover', $form_state->getValue('scroll_to_top_bg_color_hover'))
      ->set('scroll_to_top_bg_color_out', $form_state->getValue('scroll_to_top_bg_color_out'))
      ->set('scroll_to_top_display_text', (bool) $form_state->getValue('scroll_to_top_display_text'))
      ->set('scroll_to_top_enable_admin_theme', (bool) $form_state->getValue('scroll_to_top_enable_admin_theme'))
      ->save();
  }

}
