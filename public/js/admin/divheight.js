// function dashboard_upperHeight() {
//     var cal_box_height = document.getElementById('cal-box').offsetHeight;
//     var track_box = document.getElementById('track-boxes');
//     track_box.style.height = cal_box_height + 'px';
//     console.log(cal_box_height);
//     console.log(track_box.offsetHeight);
// }
// dashboard_upperHeight();

// window.addEventListener("resize", function() {
//     dashboard_upperHeight();
// });

function dashboard_upperHeight() {
    var cal_box_height = $('#cal-box').height();
    $('#track-boxes').height(cal_box_height);
    console.log(cal_box_height);
    console.log($('#track-boxes').height());
}
  
$(document).ready(function() {
    dashboard_upperHeight();
});

$(window).resize(function() {
    dashboard_upperHeight();
});