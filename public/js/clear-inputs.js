// // appointment section clear
// var confirmBtn = document.getElementById('confirm-btn');
// var appointmentForm = document.getElementById('appointment-form');


// confirmBtn.addEventListener('click', function() {
//     for (var i = 0; i < appointmentForm.elements.length; i++) {
//         var element = appointmentForm.elements[i];
//         if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
//             element.value = '';
//         } else if (element.tagName === 'SELECT') {
//             element.selectedIndex = 0;
//         }
//     }
// });

// // document modal clear 
// // PROBLEM: saon uncheck sa radio na input type,, wa pa ni nasolbad
// var backBtn = document.getElementById('back-btn');
// var documentForm = document.getElementById('document-form');

// backBtn.addEventListener('click', function() {
//     for (var i = 0; i < documentForm.elements.length; i++) {
//         var element = documentForm.elements[i];
//         if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
//             element.value = '';
//         } else if (element.tagName === 'SELECT') {
//             element.selectedIndex = 0;
//         }else if (element.tagName === 'INPUT' && element.type === 'radio') {
//             element.checked = false;
//         }
//     }
// });