$(function () {
  $('.about').on('click', function () {
    $('.about__lesson').css('display','block');
    $('.header__info').css('display','none');
    $('.header__form').css('display','none');
    $('.header__form__input_adap').css('display','none');
    $('.lesson__form').css('display','none');
    $('.header__form__input').css('display','none');
  });
  $('.header__logo').on('click', function () {
    $('.header__info').css('display','block');
    $('.header__form').css('display','none');
    $('.header__form__input_adap').css('display','none');
    $('.lesson__form').css('display','none');
    $('.about__lesson').css('display','none');
    $('.header__form__input').css('display','none');
  });
  $('.header__start').on('click', function () {
    $('.lesson__form').css('display','block');
    $('.header__form__input_adap').css('display','none');
    $('.header__form').css('display','none');
    $('.header__info').css('display','none');
    $('.about__lesson').css('display','none');
    $('.header__form__input').css('display','none');
  });
    $('.header__input__link').on('click', function () {
    $('.header__form__input').toggle();
  });
    $('.header__input__link__adap').on('click', function () {
    $('.header__form__input_adap').css('display','block');
    $('.lesson__form').css('display','none');
    $('.header__info').css('display','none');
    $('.header__info').css('display','none');
    $('.about__lesson').css('display','none');
    $('.header__form__input').css('display','none');
  });
});

//load
$(window).on('load', function () {
  setTimeout(() => {
    $('.overlay-loader').fadeOut();
  }, 2000);
  $('.loading').css('display','none');
});

// nav
$(document).ready(function() {
  $(document).delegate('.open', 'click', function(event){
    $(this).addClass('oppenned');
    event.stopPropagation();
  })
  $(document).delegate('body', 'click', function(event) {
    $('.open').removeClass('oppenned');
  })
  $(document).delegate('.cls', 'click', function(event){
    $('.open').removeClass('oppenned');
    event.stopPropagation();
  });
});

// nav
$(document).ready(function() {
  $(document).delegate('.head__nav__link', 'click', function(event){
    $('.open').removeClass('oppenned');
    event.stopPropagation();
  });
});

//animate
jQuery(document).ready(function() {
  jQuery('.lesson__blocks').addClass("hidden").viewportChecker({
    classToAdd: 'visible animated flipInX',
    offset: 100
  });
  jQuery('.kategory__icons_in').addClass("hidden").viewportChecker({
    classToAdd: 'visible animated fadeInDown',
    offset: 100
  });
  jQuery('.portfile__foto__block').addClass("hidden").viewportChecker({
    classToAdd: 'visible animated bounceInUp',
    offset: 100
  });
});
