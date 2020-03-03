/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Alfian Imanuddin
 * @copyright      Copyright (c) http://alfianimanuddin.com 
*/

// SMOOTH SCROLL
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});

// HEADER
var $window = $(window);
$window.on('scroll', function () {
    var scroll = $window.scrollTop();
    if (scroll < 95) {
		  $(".header").removeClass("bg-white");
      // $(".header").find(".nav-link").addClass("text-white");
      // $(".header").removeClass("box-shadow");
      // $(".header-dashboard").addClass("box-shadow");
    } else {
      $(".header").addClass("bg-white");
      // $(".header").find(".nav-link").removeClass("text-white");
      // $(".header").addClass("box-shadow");
      // $(".header-dashboard").addClass("box-shadow");
    }
});

// PRELOADER
function loader(){
	$(window).on('load', function() {
		$('#ctn-preloader').addClass('loaded');
		// Una vez haya terminado el preloader aparezca el scroll

		if ($('#ctn-preloader').hasClass('loaded')) {
			// Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
			$('#preloader').delay(900).queue(function () {
				$(this).remove();
			});
		}
	});
}
loader();

// FUNCTION AUTOPLAY VIDEO
function deferVideo() {

    //defer html5 video loading
  $("video source").each(function() {
    var sourceFile = $(this).attr("data-src");
    $(this).attr("src", sourceFile);
    var video = this.parentElement;
    video.load();
    // uncomment if video is not autoplay
    //video.play();
  });

}
window.onload = deferVideo;

// SELECT2
$(document).ready(function() {
  $('.select2').select2();
});

// DOPIFY
$('.dropify').dropify();

// DISABLE COPAS
// document.onkeydown = function(e) {
//   if (e.ctrlKey && 
//       (e.keyCode === 67 || 
//        e.keyCode === 86 || 
//        e.keyCode === 85 || 
//        e.keyCode === 117)) {
//       alert('not allowed');
//       return false;
//   } else {
//       return true;
//   }
// };

// DISABLE RIGHT CLICK
// document.addEventListener('contextmenu', event => event.preventDefault());