//@codekit-prepend "../../node_modules/owl.carousel/dist/owl.carousel.min.js";
//@codekit-prepend "../../node_modules/jquery-drawer/dist/js/drawer.js";
//@codekit-prepend "../../node_modules/iscroll/build/iscroll.js";
//@codekit-prepend "../../node_modules/select2/dist/js/select2.js";
//@codekit-prepend "../../node_modules/jquery.scrollto/jquery.scrollTo.min.js";

jQuery.fn.isInViewport = function() {
  var elementTop = jQuery(this).offset().top;
  var elementBottom = elementTop + jQuery(this).outerHeight();
  var viewportTop = jQuery(window).scrollTop();
  var viewportBottom = viewportTop + jQuery(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
};


jQuery(function($) {
  //jQuery('select').select2();

  jQuery('.product-subtotal').each(function() {
    $price = jQuery.trim(jQuery(this).text());
    if ($price == "$0.00") {
      jQuery(this).siblings('.product-price').find('.subscription-option').hide();
    }
  })


  jQuery('dd').filter(':nth-child(n+4)').addClass('hide');
  jQuery('dl').removeClass('active');

  jQuery('dt').on('click', function() {
    jQuery(this).addClass('active');
    jQuery('dt').not(this).removeClass('active');

    jQuery(this)
      .next()
      .slideDown(300)
      .siblings('dd')
      .slideUp(200);
  })

  jQuery('.header__cart').on('click', function(e) {
    e.preventDefault();
    jQuery('.xoo-wsc-modal').addClass('xoo-wsc-active');
  })

  jQuery('.owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 7000,
    autoplayHoverPause: true
  });
  jQuery('.hamburger').click(function() {
    jQuery(this).toggleClass('open');
    jQuery('.drawer').drawer('open');
  });

  $('.drawer').on('drawer.closed', function() {
    jQuery('.hamburger').removeClass('open');

  });

  jQuery('button.plus, button.minus').on('click', function() {

    // Get current quantity values
    var qty = jQuery('.qty');
    var val = parseFloat(qty.val());
    var max = parseFloat(qty.attr('max'));
    var min = parseFloat(qty.attr('min'));
    var step = parseFloat(qty.attr('step'));

    // Change the value if plus or minus
    if (jQuery(this).is('.plus')) {
      if (max && (max <= val)) {
        qty.val(max);
      } else {
        qty.val(val + step);
      }
    } else {
      if (min && (min >= val)) {
        qty.val(min);
      } else if (val > 1) {
        qty.val(val - step);
      }
    }
  });
  jQuery('.immediate').on('click', function(e) {
    e.preventDefault();
    jQuery('.wcsatt-options-product input:first').prop('checked', true)
    jQuery('.single_add_to_cart_button').click();
  })

  jQuery('.immediate__sub').on('click', function(e) {
    e.preventDefault();
    jQuery('.wcsatt-options-product input:last').prop('checked', true)
    jQuery('.single_add_to_cart_button').click();

  })
  jQuery(document).on('change', '.variation-radios input', function() {
    jQuery('select[name="' + jQuery(this).attr('name') + '"]').val(jQuery(this).val()).trigger('change');
  });
  jQuery('.wcsatt-options-product input:last').prop('checked', true)
  jQuery('.drawer').drawer();

  jQuery(".immediate__configure").click(function() {
    jQuery([document.documentElement, document.body]).animate({
      scrollTop: jQuery("form.cart").offset().top - 100
    }, 1000);
  });

  jQuery(".button__heading").click(function(e) {
    e.preventDefault();
    jQuery([document.documentElement, document.body]).animate({
      scrollTop: jQuery("#slide").offset().top - 100
    }, 1000);
  });

  jQuery(window).on('resize scroll', function() {
    if (jQuery('.mimic').isInViewport()) {
      jQuery('header.header').removeClass('header--slim')
    } else {
      jQuery('header.header').addClass('header--slim')
    }
  });

  var youtube = document.querySelectorAll(".youtube");

  for (var i = 0; i < youtube.length; i++) {

    var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/sddefault.jpg";

    var image = new Image();
    image.src = source;
    image.addEventListener("load", function() {
      youtube[i].appendChild(image);
    }(i));

    youtube[i].addEventListener("click", function() {

      var iframe = document.createElement("iframe");

      iframe.setAttribute("frameborder", "0");
      iframe.setAttribute("allowfullscreen", "");
      iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");

      this.innerHTML = "";
      this.appendChild(iframe);
    });
  };

  jQuery('a[href*=#]').click(function() {
    var hash = jQuery(this).attr('href');
    hash = hash.slice(hash.indexOf('#') + 1);
    jQuery.scrollTo(hash == 'top' ? 0 : 'a[name=' + hash + ']', 500);
    window.location.hash = '#' + hash;
    return false;
  });
});