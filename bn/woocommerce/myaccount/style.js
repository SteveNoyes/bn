// @codekit-prepend "../../node_modules/owl.carousel/dist/owl.carousel.js";
// @codekit-prepend "../../node_modules/select2/dist/js/select2.js";
// @codekit-prepend "../../node_modules/slicknav/dist/jquery.slicknav.js";


jQuery(function(){
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


  jQuery('#menu-main').slicknav({
    prependTo:'.mobile-nav',
    allowParentLinks: false
  });
  jQuery('.menu-toggle').on('click',function(e){
    jQuery('#menu-main').slicknav('toggle');
  })
  jQuery('.owl-carousel').owlCarousel({
    center: true,
    items:1,
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true
  });

  jQuery('.woocommerce-product-gallery__image a').on('click',function(e){
    e.preventDefault();
    console.log("Return to Sender. Signed Sealed Delivered.")
  })

  jQuery(document).ready(function() {
    jQuery('.orderby').select2();
  });
  jQuery(document).on('change', '.variation-radios input', function() {
  jQuery('select[name="'+jQuery(this).attr('name')+'"]').val(jQuery(this).val()).trigger('change');
});
jQuery( document ).ajaxComplete( function() {
    if ( jQuery( 'body' ).hasClass( 'woocommerce-checkout' ) || jQuery( 'body' ).hasClass( 'woocommerce-cart' ) ) {
        jQuery( 'html, body' ).stop();
    }
} );


});


( function() {

    var youtube = document.querySelectorAll( ".youtube" );

    for (var i = 0; i < youtube.length; i++) {

        var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";

        var image = new Image();
                image.src = source;
                image.addEventListener( "load", function() {
                    youtube[ i ].appendChild( image );
                }( i ) );

                youtube[i].addEventListener( "click", function() {

                    var iframe = document.createElement( "iframe" );

                            iframe.setAttribute( "frameborder", "0" );
                            iframe.setAttribute( "allowfullscreen", "" );
                            iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );

                            this.innerHTML = "";
                            this.appendChild( iframe );
                } );
    };

} )();
