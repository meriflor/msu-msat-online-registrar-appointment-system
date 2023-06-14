var featured = document.getElementById('content-featured-articles');
var other_ques = document.getElementById('content-other-questions');

function featuredView(){
    featured.style.display = "block";
    other_ques.style.display = "none";
}function other_quesView(){
    other_ques.style.display = "block";
    featured.style.display = "none";
}

// $('#contact-us-modal').on('show.bs.modal', function () {
//     var modalHeight = $(this).find('.modal-dialog').outerHeight();
//     var buttonHeight = $('#btn-support').outerHeight();
//     $(this).css('margin-top', -(modalHeight + buttonHeight + 20));
//   });