if (location.hash) {
  const tempHash = location.hash;
  history.replaceState(null, '', location.pathname + location.search);
  window.__pendingHashScroll = tempHash;
}
$(document).ready(function () {
  /* ======================================
  menu
  ====================================== */
  $(document).on('click', '.js-menu', function() {
    $(this).toggleClass('active')
    $(".header__content").toggleClass("is-active");
    $('body').toggleClass('lock');
    $('.js-scroll-to-top').toggleClass('is-active');
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
  table width 
  ====================================== */
  const table = $('.table02');
  function adjustTableColumns() {
    const rows = table.find('tr');
    const columnWidths = [];
    rows.each(function() {
      const cells = $(this).find('th, td');
      cells.each(function(index) {
        const contentWidth = $(this)[0].scrollWidth;
        columnWidths[index] = Math.max(columnWidths[index] || 0, contentWidth);
      });
    });

    rows.each(function() {
      const cells = $(this).find('th, td');
      cells.each(function(index) {
        $(this).css('max-width', `${columnWidths[index]}px`);
      });
    });
  }
  adjustTableColumns();
  $(window).on('resize', adjustTableColumns);
  /* ======================================
  banner sticky
  ====================================== */
  $('.banner__sticky .close').click(function () {
		$(this).parent().fadeOut();
	});
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

