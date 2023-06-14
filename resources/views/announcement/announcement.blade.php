<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement | MSU-MSAT Registrar's Online Appointment</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/faqs-announcement/announcement.css">
    <link rel="stylesheet" href="css/faqs-announcement/fonts.css">
    <link rel="stylesheet" href="css/defaultcss/contact-us.css">
    
    <script src="https://kit.fontawesome.com/7856143440.js" crossorigin="anonymous"></script>
    <style>
        #back-to-top-btn{
            color: white;
            height: auto;
            width: auto;
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
            border: none;
            background: maroon !important;
            border-radius: 100px !important;
        }#announcement-list a{
            text-decoration:none;
            color: #131313;
            border-radius:0;
        }#announcement-list a:not(:last-child) {
            border-bottom: 1px solid #ccc;
        }#announcement-list a:hover{
            background-color:rgb(230, 147, 147);
        }
    </style>
</head>
<body>
    <div class="announcement-cover">
        <div class="content">
            <div class="bar p-2">
                <div class="container d-flex flex-row align-items-center justify-content-between">
                    <div class="logo-container d-flex flex-row align-items-center">
                        <div class="logo">
                            <img class="image-fluid" src="/images/msat-logo.png" alt="">
                        </div>
                        <p class="text-wrap font-body font-quick font-bold fs-6 font-white ps-3 m-0">MSU-MSAT Registrar's Online Appointment</p>
                    </div>
                </div>
            </div>
            <div class="head container d-flex flex-column align-items-center justify-content-center font-white">
                <p class="display-2 font-corm font-bold">Announcements</p>
                <p class="h4 font-corm">Latest News and Updates</p>
            </div>
        </div>
    </div>

    <div class="announcement-content row">
        @if(count($announcements)>0)
        <div class="col-md-4">
            <div class="d-none d-md-block">
                <div id="announcement-list" class="d-flex flex-column gap-2 text-start">
                @foreach($announcements as $announcement)
                    <a class="p-3 font-nun font-bold fs-6" href="#{{ $announcement->id }}">
                        <div>{{ $announcement->announcement_title }}</div>
                    </a>
                @endforeach
                </div>
            </div>
            <div class="dropdown d-md-none w-100 row mb-4">
                <button class="btn dropdown-toggle" type="button" id="dropdownAnnouncement"  data-bs-toggle="dropdown" aria-expanded="false">
                  Announcements
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownAnnouncement">
                    @foreach($announcements as $announcement)
                        <a class="dropdown-item" href="#{{ $announcement->id }}">{{ $announcement->announcement_title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div data-bs-spy="scroll" data-bs-target="#announcement-list" data-bs-offset="0" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                @foreach($announcements as $announcement)
                <div>
                    <div id="{{ $announcement->id }}" class="h4 font-bold font-karma pt-2">
                        {{ $announcement->announcement_title }}
                    </div>
                    <small id="post-date" class="font-karma row m-0 p-0">Posted on: {{ $announcement->created_at->format('M d,Y') }}</small>
                    <pre id="post-content" class="pt-4 font-nun fs-6" style="text-align:justify;">
                        {{ $announcement->announcement_text }}
                    </pre>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- contact us section -->
    <div class="fixed-bottom" id="contactus">
        <button id="back-to-top-btn" class="btn me-3 d-flex flex-row align-items-center" style="">&#8593 Top</button>
        <button class="btn font-sanc" id="btn-support" data-bs-toggle="modal" data-bs-target="#contact-us-modal">
            <i class="fa-regular fa-message icon-support"></i>
        </button>
    </div>

    @include('layout.modal.contact-us')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <script src="js/navbar.js"></script>
    <script src="js/faqs/faqs.js"></script>
    <script>
        const backToTopBtn = document.querySelector("#back-to-top-btn");

        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 100) {
                backToTopBtn.classList.add("show");
                backToTopBtn.classList.remove("hide");
            } else {
                backToTopBtn.classList.add("hide");
                backToTopBtn.classList.remove("show");
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>
</body>
</html>