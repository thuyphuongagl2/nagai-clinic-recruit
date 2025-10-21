$(document).ready(function () {
  /* ======================================
  menu
  ====================================== */
  $('.js-menu').click(function () {
    $(this).toggleClass('active')
    $(".header__content").toggleClass("is-active");
    $('body').toggleClass('lock');
    $('.js-scroll-to-top').toggleClass('is-active');
  })
  /* ======================================
  nav
  ====================================== */
  if (window.innerWidth > 768) { 
    if( $(".header__nav").length ) {
      $(".header__nav > ul > li").on("mouseenter", function(){
        $(this).find(".subInner").addClass("active");
        $(this).find(".menu__title, .menu__link").addClass("active");
      });
      $(".header__nav > ul > li").on("mouseleave", function(){
        $(this).find(".subInner").removeClass("active");
        $(this).find(".menu__title, .menu__link").removeClass("active");
      });
    }
  }
  /* ======================================
  subnmenu
  ====================================== */
 
  $('.menu li').each(function() {
    let that = $(this);
    let menu = that.children('.subInner');
    if (menu.length) {
      let link = that.children('a');
      if (link.length) {
        link.append('<span class="nav__item-btn"></span>');
      }
    }
  });
  
  $(".nav__item-btn, .menu__title").on("click", function () {
    var vw = $(window).innerWidth();
    if (vw < 1301) {
      $(this).toggleClass("is-open");
      // console.log($(this).closest('li').find('.subInner')); 
      $(this).closest('li').find('.subInner').slideToggle();
    }
  });
  /* ======================================
  tabs
  ====================================== */
  $('.js-tab').each(function () {
    let tab = $(this)
    let tabNav = tab.find('.js-tab-nav li')
    let tabPanel = tab.find('.js-tab-content .panel')

    tabNav.click(function () {
      let item = $(this)
      let dataID = item.data('id')

      item.addClass('active')

      tabNav.not(item).removeClass('active')

      tabPanel.hide()
      $('#' + dataID).fadeIn()
    })
  })

  /* ======================================
  FAQ
  ====================================== */
  // $('.js-accordion-head').each(function () {
  //   let head = $(this)
  //   let body = head.next()

  //   head.click(function () {
  //     head.toggleClass('is-active')
  //     body.slideToggle()
  //   })
  // })
  $('.js-accor').each(function () {
    $('.js-accor-heading', this).on('click', function () {
      $(this).closest('.js-accor').toggleClass('is-open');
      $(this).closest('.js-accor').find('.js-accor-content').slideToggle();
    });
  });
 /* ======================================
  Scroll to top
  ====================================== */
  const $btnToTop = $(".js-scroll-to-top");
  if ($btnToTop.length) {
    $(window).on("scroll", function() {
      if ($(this).scrollTop() > 10) {
        $btnToTop.addClass("is-active");
        $('.header').addClass('active')
      } else {
        $btnToTop.removeClass("is-active");
        $('.header').removeClass('active');
      }
    });
    $btnToTop.on("click", function() {
      $("body, html").animate({ scrollTop: 0 }, "fast");
    });
    $(document).scroll(function() {
      if ($(window).scrollTop() > 10) {
        $btnToTop.addClass("is-active");
      } else {
        $btnToTop.removeClass("is-active");
      }
    });
  }

  //Scroll
  SmoothScroll()
})

function SmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', event => {
      event.preventDefault();
      const targetId = link.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        scroll(targetElement);
      }
    });
  });
}
function scroll(targetElement) {
  const headerElms = document.querySelectorAll('.header');
  let headerOffset = 0;
  headerElms.forEach(headerElm => {
    headerOffset += headerElm.offsetHeight;
  });
  const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
  const offsetPosition = elementPosition - headerOffset;
  window.scrollTo({
    top: offsetPosition,
    behavior: "smooth"
  });
}
