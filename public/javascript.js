/* global $ */

var headings = document.querySelectorAll('h4');
for (var i = 0; i < headings.length; i++) {
  headings[i].addEventListener('click', function() {
    this.querySelector('.tooltip').classList.add('tooltip-on');
  });
  headings[i].addEventListener('mouseout', function() {
    this.querySelector('.tooltip').classList.remove('tooltip-on');
  });
}

$(window).scroll(function() {
  var height = $(window).scrollTop();
  if (height > 100) {
    $('#back-to-top').fadeIn();
  } else {
    $('#back-to-top').fadeOut();
  }
});

$(document).ready(function() {
  $('#back-to-top').click(function(event) {
    event.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, 1000);
    return false;
  });
});

var box = document.getElementById('cookiebox');

document.getElementById('cookiebox__close').onclick = function() {
  msgbox();
};

function msgbox() {
  box.style.display = 'none';
  sessionStorage.setItem('visited', 'none');
}

box.style.display = sessionStorage.getItem('visited');
