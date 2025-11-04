if (location.hash) {
  const tempHash = location.hash;
  history.replaceState(null, '', location.pathname + location.search);
  window.__pendingHashScroll = tempHash;
}
$(document).ready(function () {
  /* ======================================
  menu
  ====================================== */
  $(document).on('click', '.js-menu', function () {
    $(this).toggleClass('active')
    $(".header__content, .header__inner").toggleClass("is-active");
    $('body').toggleClass('lock');
    if ($(this).hasClass('active')) {
      $('.header').addClass('is-fixed');
    } else {
      if ($(window).scrollTop() > 200 || $('.header').hasClass('header__under')) {
        $('.header').addClass('is-fixed');
      } else {
        $('.header').removeClass('is-fixed');
      }
    }
  })
  /* ======================================
  mv height
  ====================================== */
  // $(document).ready(function() {
  //   function setMVHeight() {
  //     if ($(window).width() <= 768) {
  //       const windowHeight = $(window).innerHeight();
  //       const bannerHeight = $('.fixed__banner').outerHeight() || 0;
  //       const paddingTop = parseInt($('.mv').css('padding-top')); 
  //       $('.mv').height(windowHeight - bannerHeight - paddingTop); 
  //     } else {
  //       $('.mv').css('height', '');
  //     }
  //   }
  //   setMVHeight(); 
  //   $(window).resize(setMVHeight);
  // });

  /* ======================================
  nav hover
  ====================================== */
  if ($(window).width() > 768 && $('.header__nav').length) {
    $(document).on('mouseenter', '.header__nav > ul > li', function () {
      $(this).find('.subInner').addClass('active');
      $(this).find('.menu__title, .menu__link').addClass('active');
    });
    $(document).on('mouseleave', '.header__nav > ul > li', function () {
      $(this).find('.subInner').removeClass('active');
      $(this).find('.menu__title, .menu__link').removeClass('active');
    });
  }
  /* ======================================
  subnmenu
  ====================================== */
  $('.menu li').each(function () {
    const menu = $(this).children('.subInner');
    const link = $(this).children('a');
    if (menu.length && link.length) {
      link.append('<span class="nav__item-btn"></span>');
    }
  });

  $(document).on('click', '.nav__item-btn, .menu__title', function () {
    if ($(window).width() < 1301) {
      $(this).toggleClass('is-open');
      $(this).closest('li').find('.subInner').slideToggle();
    }
  });
  /* ======================================
  header fixed
  ====================================== */
  if (!$('.js-menu').hasClass('active')) {
    if ($('.header').hasClass('header__under')) {
      $('.header').addClass('is-fixed');
    } else {
      if ($(window).scrollTop() > 200) {
        $('.header').addClass('is-fixed');
      } else {
        $('.header').removeClass('is-fixed');
      }
    }
  }
  $(window).on('scroll load', function () {
    $('.header').length && $(window).scrollTop() > 0 ? $('.header').addClass('is-fixed') : $('.header').removeClass('is-fixed');
  })
  /* ======================================
  tabs
  ====================================== */
  $('.js-tab').on('click', '.tab__txt', function (e) {
    e.preventDefault();
    var tabId = $(this).attr('data-tab');
    $(this).closest('.js-tab').find('.tab__txt').removeClass('is-active');
    $(this).addClass('is-active');
    $('.tab__content').removeClass('is-active');
    $('#' + tabId).addClass('is-active');
  });

  /* ======================================
  FAQ
  ====================================== */
  $('.js-accor').each(function () {
    $('.js-accor-heading', this).on('click', function () {
      $(this).closest('.js-accor').toggleClass('is-open');
      $(this).closest('.js-accor').find('.js-accor-content').slideToggle();
    });
  });
  /* ======================================
   Scroll to top
   ====================================== */
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.js-totop').addClass('is-active');
    } else {
      $('.js-totop').removeClass('is-active');
    }
  });

  $(document).on('click', '.js-totop', function () {
    $('html, body').animate({ scrollTop: 0 }, 800);
    return false;
  });
  /* ======================================
  Remove &nbsp header footer
  ====================================== */
  $('.footer, .header').find('*').each(function () {
    $(this).html($(this).html().replace(/&nbsp;/g, ''));
  });

  /* ======================================
  banner sticky
  ====================================== */
  $('.banner__sticky .close').click(function () {
    $(this).parent().fadeOut();
  });
  /* ======================================
  modal
  ====================================== */
  $('.sticky .map').on('click', function () {
    $('.sticky .map').toggleClass('active');
    $('.sticky .modal-map').toggleClass('active');
  });





gsap.registerPlugin(ScrollTrigger);

// constants
let allowScroll = true; // sometimes we want to ignore scroll-related stuff, like when an Observer-based section is transitioning.
let scrollTimeout = gsap.delayedCall(1, () => (allowScroll = true)).pause(); // controls how long we should wait after an Observer-based animation is initiated before we allow another scroll-related action
const time = 0.5; // animation duration
let animating = false; // state

// Progressive enhancement
gsap.set(".reason__item", {
  y: (index) => 20 * index,
  transformOrigin: "center top"
});

//--------------------------------//
// The timeline
//--------------------------------//
const tl = gsap.timeline({
  paused: true
});

tl.add("card2");
tl.to(".reason__item:nth-child(1)", {
  scale: 0.85,
  duration: time,
  backgroundColor: "#3498db"
});
tl.from(
  ".reason__item:nth-child(2)",
  {
    y: () => window.innerHeight,
    duration: time
  },
  "<"
);

tl.add("card3");
tl.to(".reason__item:nth-child(2)", {
  scale: 0.9,
  duration: time,
  backgroundColor: "#3498db"
});
tl.from(
  ".reason__item:nth-child(3)",
  {
    y: () => window.innerHeight,
    duration: time
  },
  "<"
);

tl.add("card4");
tl.to(".reason__item:nth-child(3)", {
  scale: 0.95,
  duration: time,
  backgroundColor: "#3498db"
});
tl.from(
  ".reason__item:nth-child(4)",
  {
    y: () => window.innerHeight,
    duration: time
  },
  "<"
);
tl.add("card5");
// END The timeline --------------//

function tweenToLabel(direction, isScrollingDown) {
  if (
    (!tl.nextLabel() && isScrollingDown) ||
    (!tl.previousLabel() && !isScrollingDown)
  ) {
    cardsObserver.disable(); // resume native scroll
    return;
  }
  if (!animating && direction) {
    // Check if we're already animating
    animating = true;
    tl.tweenTo(direction, { onComplete: () => (animating = false) });
  }
}

//--------------------------------//
// Observer plugin
//--------------------------------//
const cardsObserver = Observer.create({
  // type: "wheel,touch,pointer",
  wheelSpeed: -1,
  onDown: (self) => tweenToLabel(tl.previousLabel(), false),
  onUp: (self) => tweenToLabel(tl.nextLabel(), true),
  tolerance: 10,
  preventDefault: true,
  onEnable(self) {
    allowScroll = false;
    scrollTimeout.restart(true);
    // when enabling, we should save the scroll position and freeze it. This fixes momentum-scroll on Macs, for example.
    let savedScroll = self.scrollY();
    self._restoreScroll = () => self.scrollY(savedScroll); // if the native scroll repositions, force it back to where it should be
    document.addEventListener("scroll", self._restoreScroll, {
      passive: false
    });
  },
  onDisable: (self) =>
    document.removeEventListener("scroll", self._restoreScroll)
});

cardsObserver.disable(); // Disable one page load
// END Observer plugin --------------//

//--------------------------------//
// ScrollTrigger that disables the scroll and has the Observer plugin take over
//--------------------------------//
ScrollTrigger.create({
  id: "STOP-SCROLL",
  trigger: ".reason__list",
  pin: true,
  start: "top 20%",
  end: "+=100",
  onEnter: (self) => {
    if (cardsObserver.isEnabled) return;
    cardsObserver.enable(); // STOP native scrolling
  },
  onEnterBack: (self) => {
    if (cardsObserver.isEnabled) return;
    cardsObserver.enable(); // STOP native scrolling
  }
});

// END ScrollTrigger that disables the scroll and has the Observer plugin take over  --------------//
});




$(function () {
  $('a[href*=\\#]:not([href=\\#])').click(function () {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
      var $target = $(this.hash);
      $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
      var offsetTop = $(".header__inner").outerHeight() + 50;
      if ($target.length) {
        var targetOffset = $target.offset().top - offsetTop + 1;
        $('html,body').animate({ scrollTop: targetOffset }, 1000);
        return false;
      }
    }
  });
});
// Scroll to anchor if coming from another page
if (location.hash) {
  const hash = location.hash;
  history.replaceState(null, '', location.pathname + location.search);
  window.__pendingHashScroll = hash;
}

$(window).on('load', function () {
  const hash = window.__pendingHashScroll;
  if (hash) {
    const $target = $(hash);
    const offsetTop = $(".header__inner").outerHeight() || 0;

    setTimeout(function () {
      if ($target.length) {
        $('html, body').animate({
          scrollTop: $target.offset().top - offsetTop + 1
        }, 800, function () {
          history.replaceState(null, '', location.pathname + location.search + hash);
        });
      }
    }, 300);
  }
});

