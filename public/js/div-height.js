// function setCoverHeight() {
//     var homepageCover = document.querySelector('.homepage-cover');
//     var navbar = document.querySelector('.navbar');
//     var coverContent = document.querySelector('.content-cover');

//     var coverHeight = navbar.offsetHeight + coverContent.offsetHeight;
//     homepageCover.style.height = coverHeight + 'px';
    
//     console.log(navbar.offsetHeight);
//     console.log(coverContent.offsetHeight);
// }

// setCoverHeight();

function setCoverHeight() {
    var homepageCover = document.querySelector('.homepage-cover');
    var navbar = document.querySelector('.navbar');
    var coverContent = document.querySelector('.content-cover');

    var coverHeight = homepageCover.offsetHeight - navbar.offsetHeight;
    coverContent.style.height = coverHeight + 'px';
}

setCoverHeight();


//setting everytime a user resizes the window
window.addEventListener('resize', function() {
    setCoverHeight();
    console.log('Window resized!');
});

function setArticleDocHeight(){
    var rowHeight = document.querySelector('.appointment-forms');
    var appointment = document.querySelector('.appointment01');

    appointment.style.height = rowHeight.offsetHeight + 'px';
}

setArticleDocHeight();


function setAboutImageHeight(){
    var aboutTitle = document.querySelector('.about-title');
    var aboutSubtitle = document.querySelector ('.about-subtitle');
    var aboutDetails = aboutTitle.offsetHeight + aboutSubtitle.offsetHeight;

    var aboutImage = document.querySelector('.about-image');
    aboutImage.style.height = aboutDetails.offsetHeight + 'px';
    console.log(aboutImage);
}

setAboutImageHeight();

window.addEventListener('resize', function() {
    setAboutImageHeight();
    console.log('Window resized!');
});
