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

  /* DISPLAY TEAM LIST FOR A MATCH*/
  $('.displayList').click(function(e){
    e.preventDefault();

    var target = $(this).attr('data-target');

    $(target).modal('toggle');
  })

  /* FEED Indiv list for ADD/EDIT EVENTS*/
  $('#IdIndividus').on('change', function(){
    var html = '';

    $('#IdIndividus option:selected').each(function(index, el) {
      html += '<li>';
      html += el.text;
      html += '</li>';
    });

    $('#indivList').html(html);

  });

  $('.event-list').on('change', function(){
    var html = '',
        target = '#' + $(this).attr('data-listId');

    $(this).find('option:selected').each(function(index, el) {
      html += '<li>';
      html += el.text;
      html += '</li>';
    });

    $(target).html(html);
  });

  $('.editForms').on('click', function(){
    var target = '#' + $(this).attr('data-target');

    $('.my-events__view__forms form').hide();

    $('.my-events__view__forms ' + target ).slideToggle();
    $('.my-events__view__forms ' + target ).find('.chosen-container').css('width', '100%');
  });

  $('.viewEvent').on('click', function(){
    var idEvent = $(this).attr('data-idEvent'),
        target = '#viewEvent';

    getClassement(idEvent, target);
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

function getClassement(idEvent, target){
  $.ajax({
    'url' : '/events/ajax_getClassement/' + idEvent,
    'method' : 'GET',
    'success' : function (data){
      console.log(JSON.parse(data));
      var data = JSON.parse(data),
          html = '';

      
      html += "<h3>NOM DE L'ÉVÉNEMENT</h3>";
      html += "<h4>Classement</h4>";

      html += '<table class="table table-responsive table-striped">';
      html += "<tr>";
      html += "<th>Nom</th>";
      html += "<th>V</th>";
      html += "<th>D</th>";
      html += "<th>PJ</th>";
      html += "</tr>";

      html += "<tr>";
      html += "<th>Nom</th>";
      html += "<th>V</th>";
      html += "<th>D</th>";
      html += "<th>PJ</th>";
      html += "</tr>";

            
      html += "</table>";
      
     
     $(target).html(html);
     $(target).slideToggle();
    },
    'error' : function(err){
      console.log(err);
    }
  })
}
