<?php wp_footer(); ?>
</main>

<footer class="footer">
  <div class="center">footer</div>
  <?php
  // wp_nav_menu(array(
  //   'menu_class' => "list02 list02--style01",
  //   'container' => "ul",
  //   'container_class' => "1",
  //   'theme_location' => "footer_menu2",
  //   'list_item_class'  => 'list02__item',
  //   'link_class'   => 'nav__link',
  // ));
  // wp_nav_menu(array(
  //   'menu_class' => "list02 list02--style01",
  //   'container' => "ul",
  //   'container_class' => "1",
  //   'theme_location' => "footer_menu3",
  //   'list_item_class'  => 'list02__item',
  //   'link_class'   => 'nav__link',
  // ));
  // wp_nav_menu(array(
  //   'menu_class' => "list02 list02--style01",
  //   'container' => "ul",
  //   'container_class' => "1",
  //   'theme_location' => "footer_menu4",
  //   'list_item_class'  => 'list02__item',
  //   'link_class'   => 'nav__link',
  // ));
  // wp_nav_menu(array(
  //   'menu_class' => "list02 list02--style01",
  //   'container' => "ul",
  //   'container_class' => "1",
  //   'theme_location' => "footer_menu5",
  //   'list_item_class'  => 'list02__item',
  //   'link_class'   => 'nav__link',
  // ));
  // wp_nav_menu(array(
  //   'menu_class' => "list02 list02--style01",
  //   'container' => "ul",
  //   'container_class' => "1",
  //   'theme_location' => "footer_menu6",
  //   'list_item_class'  => 'list02__item',
  //   'link_class'   => 'nav__link',
  // ));
  ?>
  <div class="js-scroll-to-top">
    <span></span>
  </div>
</footer>


<!--javascript-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>
<script>
  AOS.init({
    // Global settings:
    disable: 'mobile', // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'load', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 0, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 300, // the delay on throttle used while scrolling the page (advanced)

    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 100, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 1200, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: true, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  })
</script>
<?php if (is_front_page()) : ?>
  <script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".js-mainvisual").slick({
        autoplay: true,
        speed: 1000,
        delay: 5000,
        infinite: true,
        slidesToShow: 1,
        arrows: false,
        dots: false,
        fade: true,
        cssEase: 'linear'
      });
      $('.js-slider01').slick({
        accessibility: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 6000,
        cssEase: 'linear',
        pauseOnHover: false,
        pauseOnFocus: false,
        variableWidth: true,
        draggable: false,
        arrows: false,
      })
    })
  </script>
<?php endif; ?>
</main>
</body>

</html>