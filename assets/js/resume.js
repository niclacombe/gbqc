/*!
 * Start Bootstrap - Resume v5.0.8 (https://startbootstrap.com/template-overviews/resume)
 * Copyright 2013-2019 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-resume/blob/master/LICENSE)
 */

$(document).ready(function() {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#sideNav'
  });

  // Makes select with class .select-chosen filterable
  $('select.select-chosen').chosen({
    inherit_select_classes : true,
    no_results_text: "Aucune correspondance",
  });

  //Get Joueurs AJAX  $(function(){
  $('.select_guilde').on('change',function(){
    var target = $(this).attr('data-target'),
        idGuilde = $(this).find('option:selected').val();

    getJoueurs(idGuilde, target);
  });

  $('.slick-results').slick({
    adaptiveHeight: true,
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });

  $('.displayList').click(function(e){
    e.preventDefault();

    var target = $(this).attr('data-target');

    $(target).modal('toggle');
  })

}); // End of use strict

function getJoueurs(idGuilde, target){
  $.ajax({
    'url' : "/matches/ajax_getJoueurs",
    'method' : 'POST',
    'data' : {
      'idGuilde' : idGuilde,
    },
    'success' : function(data){
      var data = (JSON.parse(data)),
          html = '';

      $.each(data, function(index, el){
        html += '<option value="' + el.Id +'">';
        html += el.Nom;
        if(el.Position == 'CAPTAI'){
          html += ' (Captain)';
        }else if(el.Position == 'MASCOT'){
          html += ' (Mascot)';
        }else if(el.Position == 'MASTER'){
          html += ' (Master)';
        }else if(el.Position == 'APPREN'){
          html += ' (Apprentice)';
        }
        html +='</option>';
      });

      $('#' + target).html(html);

    },
    'error' : function(err){
      console.log(err);
    }
  });
}
