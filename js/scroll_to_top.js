(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * Toggle the visibility of the scroll to top link.
   */
  Drupal.behaviors.scroll_to_top = {
    attach: function (context) {
      // Append  back to top link top body if it is not.
      if ($('#back-top').length === 0) {
        $('body').append("<p id='back-top'><a href='#top'><span id='button'></span><span id='link'>" + drupalSettings.scroll_to_top.label + "</span></a></p>");
      }

      // Preview function.
      $("#scroll-to-top-form").on('change', 'input', function () {
        // Building the style for preview.
        var style = "<style>#scroll-to-top-prev-container #back-top-prev span#button-prev{ background-color:" + $("#edit-scroll-to-top-bg-color-out").val() + ";} #scroll-to-top-prev-container #back-top-prev span#button-prev:hover{ background-color:" + $("#edit-scroll-to-top-bg-color-hover").val() + " }</style>";
        // Building the html content of preview.
        var html = "<p id='back-top-prev' style='position:relative;'><a href='#top'><span id='button-prev'></span><span id='preview-link'>";
        // If label enabled display it.
        if ($("#edit-scroll-to-top-display-text").prop('checked')) {
          html += $("#edit-scroll-to-top-label").val();
        }
        html += "</span></a></p>";
        // Update the preview.
        $("#scroll-to-top-prev-container").html(style + html);
      });

      $("#back-top").hide();

      $(function () {
        $(window).scroll(function () {
          if ($(this).scrollTop() > 100) {
            $('#back-top').fadeIn();
          }
          else {
            $('#back-top').fadeOut();
          }
        });

        // Scroll body to 0px on click.
        $('#back-top a').on('click', function () {
          $('body,html').animate({
            scrollTop: 0
          }, 800);
          return FALSE;
        });
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
