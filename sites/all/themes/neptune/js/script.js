/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {

// Minify the navigation at mobile resolutions.
Drupal.behaviors.nav = {
  attach: function (context, settings) {
    $('#navigation:not(.nav-processed)', context).addClass('nav-processed').each(function() {

      // Add a helper class to the #navigation div if it [the div]
      // contains content. This helper class is used for styling.
      if ($.trim($(this).html()).length) {
        $(this).addClass('has-content');
      }

      // miniNav().
      function miniNav() {

        // Only add the #nav-togg HTML if the #navigation div
        // contains something to toggle.
        if ($.trim($('#navigation').html()).length) {

          // Translatable text for the #nav-togg label.
          var showText = Drupal.t('Show nav');
          var hideText = Drupal.t('Hide nav');

          // Hide the #navigation div.
          $('#navigation').hide();

          // Insert the #nav-togg HTML.
          $('#navigation').before('<a href="#" id="nav-togg"><span>'+showText+'</span></a>');

          // Handle #nav-togg clicks.
          $('#nav-togg').click(function(){
            $('#navigation').toggle();
            $('span', this).text($('span', this).text() == showText ? hideText : showText);
            return false;
          });
        }
      }

      // If necessary, trigger miniNav().
      // Note: the body:after content is generated via a media query in pages.scss.
      // See: http://adactio.com/journal/5429/ for an explanation.
      var size = window.getComputedStyle(document.body,':after').getPropertyValue('content');
      if (size.indexOf("minw768") == -1) {
        miniNav();
      }

      // On window resize...
      $(window).resize(function() {

        // Retrieve body:after.
        var size = window.getComputedStyle(document.body,':after').getPropertyValue('content');

        // If necessary, trigger miniNav().
        if (size.indexOf("minw768") == -1 && $("#nav-togg").length == 0) {
          miniNav();
        }

        // If necessary, remove #nav-togg and show the #navigation div.
        else if (size.indexOf("minw768") != -1 && $("#nav-togg").length > 0) {
          $('#nav-togg').remove();
          $('#navigation').show();
        }
      });
    });
  }
};

})(jQuery, Drupal, this, this.document);
