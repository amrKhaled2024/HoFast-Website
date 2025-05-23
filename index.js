const slider_bar = document.getElementById("slider_bar");
const body = document.getElementById("all");
const comment_all = document.getElementById("comment_all");
const comment_txt = document.getElementById("AddCommentText");
const welcoming = document.getElementById('welcoming');
const nav = document.getElementById('nav');

function close_welcoming(){
  welcoming.style.display = 'none';
}

function close_slider() {

  slider_bar.style.right = "-400px";

}
function open_slider() {

  slider_bar.style.right = "0px";

}




function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

document.getElementById('SignUpForm').addEventListener('submit', function(e) {
  const emailInput = document.getElementById('email').value.trim();

  if (!validateEmail(emailInput)) {
    e.preventDefault(); 
    alert('Please Enter a valid Email');
  }
});

$(document).ready(function() {
    $(".progilePic").hover(
        function () {
            $(this).find(".profile_slider").stop(true, true).fadeIn(600);
        },
        function () {
            $(this).find(".profile_slider").stop(true, true).fadeOut(600);
        }
    );
});


$(document).ready(function(){
  let currentImage = null;

  $('.imageBox').click(function(){
    currentImage = $(this);
    $('#fileInput').click();
  });

  $('#fileInput').change(function(e){
    const file = this.files[0];
    if (file && currentImage) {
      const reader = new FileReader();
      reader.onload = function(e) {
        currentImage.attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    }
  });
});
