
jQuery(document).ready(function($) {

    $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 800, 'swing');
    });
});

// uniform
$(function() {
    $('input[type="checkbox"], input[type="radio"], select').uniform();
});

// social icon
$(document).ready(function($) {
    $('.social i').tooltip('hide')
});

// 

var wow = new WOW({
    boxClass: 'wowload', // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset: 0, // distance to the element when triggering the animation (default is 0)
    mobile: true, // trigger animations on mobile devices (default is true)
    live: true // act on asynchronously loaded content (default is true)
});
wow.init();




$('.carousel').swipe({
    swipeLeft: function() {
        $(this).carousel('next');
    },
    swipeRight: function() {
        $(this).carousel('prev');
    },
    allowPageScroll: 'vertical'
});

$('#selesai_checkbox').on('click', (e) => {
    source = e.target;

    affect1 = document.getElementById('cari_button');
    affect2 = document.getElementById('selesai_button');


    if (source.checked) {
        affect2.classList.remove('d-none');
        affect1.classList.add('d-none');



    }
    else {
        affect2.classList.add('d-none');
        affect1.classList.remove('d-none');

    }

});


$('input[set=sinkron]').on('change', (e) => {

    source = e.target;
    target = $(source.getAttribute('to'))[0];

    maks = source.getAttribute('max');

    if ( Number(source.value) > maks) {
      source.value = maks;
    } else if ( Number(source.value) < 0) {
      source.value = 0;
    }

    target.value = source.value;

});

$('input[set=sinkron]').change();

$('a[set=kamar_hapus]').on('click', (e) => {
  source = e.target;

  appendTo = $(source.getAttribute('append'))[0];
  id_data = source.getAttribute('id_data');

  hidden = document.createElement('input');
  hidden.type = "hidden";
  hidden.name = "hapus_terpilih[]";
  hidden.value = id_data;

  appendTo.appendChild(hidden);

  source.parentElement.parentElement.remove();
});