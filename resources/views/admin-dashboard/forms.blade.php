@extends('admin-dashboard.admin')

@section('content')
    <!-- header -->
    <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn d-flex flex-row align-items-center" id="menu-btn">
            <img src="/images/back-arrow.png" alt="" />
            <p class="m-0 p-0 font-nun fs-6 ms-2" id="page-title">
                Forms Configuration
            </p>
        </a>
    </div>

    <!-- small navigation -->
    <!-- TODO forms content -->

    <div class="d-flex flex-column">
        <nav class="navigation this-box">
            <ul class="font-nun small-nav">
            <li><a href="#forms">Forms</a></li>
            <li><a href="#courses">Courses</a></li>
            </ul>
        </nav>

        <!-- fix sectionf forms -->
            <section id="forms" class="mt-4 mb-2">
            <div id="forms-head" class="w-100 px-5 d-flex flex-row justify-content-between align-items-center">
                <div class="title font-nun font-bold fs-3">Forms</div>
                <button class="btn btn-custom d-flex flex-row align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#addFormModal">
                    <div class="logo">
                        <img src="/images/add.png" alt="">
                    </div>
                    <small class="m-0 ms-2 p-0 font-nun">Add</small>
                </button>
            </div>
            <div id="forms-body" class="this-box mt-2">
                <div class="accordion" id="forms-list">
                @foreach ($forms as $form)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $form->id }}" aria-expanded="false" aria-controls="1">
                            <!-- Issuance of Transcript of Records (TOR) -->   {{ $form->name }}
                            </button>
                        </h2>
                        <div id="{{ $form->id }}" class="accordion-collapse collapse" data-bs-parent="#forms-list">
                            <div class="accordion-body d-flex flex-column">
                                <div class="body-content">
                                    <div class="d-flex flex-row p-0 my-2">
                                        @if($form->acad_year == 1)
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="d-flex" style="width: 20px; height: 20px;">
                                                <img class="w-100 h-100" src="/images/checkbox.png" alt="">
                                            </div>
                                            <small class="ms-2 p-0" style="color: maroon;">Asks for Academic Year</small>
                                        </div>
                                        @endif
                                        @if($form->requirements == 1)
                                        <div class="d-flex flex-row align-items-center ms-5">
                                            <div class="d-flex" style="width: 20px; height: 20px;">
                                                <img class="w-100 h-100" src="/images/checkbox.png" alt="">
                                            </div>
                                            <small class="ms-2 p-0" style="color: maroon;">Asks for Requirements</small>
                                        </div>
                                        @endif
                                    </div>
                                    <hr class="font-88">
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Availability of the Service</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content"> {{ $form->form_avail }}</p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Who May Avail the Service</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content"> {{ $form->form_who_avail }}</p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">What Are the Requirements</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content">{{ $form->form_requirements }}</p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Complete Processing Time: </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content">{{ $form->form_process }}</p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    <!-- review form -->
                                    @if($form->fee > 0)
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Document Fee: </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content">PHP {{ $form->fee }}.00 
                                            @if($form->fee_type != "None")
                                            <span class="info-content">{{ $form->fee_type }}</span>
                                            @endif
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    @endif
                                    @if($form->pages > 1)
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Pages: </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content">At least {{ $form->pages }} pages</p>
                                        </div>
                                    </div>
                                    <hr class="font-88">
                                    @endif
                                    <div class="row w-100 p-0 my-2">
                                        <div class="col-md-6">
                                            <p class="info-title">Maximum Time to Claim</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="info-content">{{ $form->form_max_time }} after the request if filed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="body-buttons d-flex flex-row justify-content-end mt-2">
                                    <button class="btn btn-custom d-flex flex-row align-items-center open_edit_form_modal" type="button" data-form-edit-id="{{ $form->id }}">
                                        <img src="/images/edit.png" alt="">
                                        <small class="m-0 ms-2 p-0 font-nun">Edit</small>
                                    </button>
                                    <button class="btn btn-custom d-flex flex-row align-items-center open_delete_form_modal" type="button" data-form-delete-id="{{ $form->id }}" data-form-delete-name="{{ $form->name }}">
                                        <img src="/images/delete.png" alt="">
                                        <small class="m-0 ms-2 p-0 font-nun">Delete</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </section>
        
        
        <!-- fix section courses -->
        <section id="courses" class="mt-2 mb-2">
           
            <div id="courses-head" class="w-100 px-5 d-flex flex-row justify-content-between align-items-center">
                <div class="title font-nun font-bold fs-3">Courses</div>
                <button class="btn btn-custom d-flex flex-row align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    <div class="logo">
                        <img src="/images/add.png" alt="">
                    </div>
                    <small class="m-0 ms-2 p-0 font-nun">Add</small>
                </button>
            </div>
           
            <div id="courses-body" class="this-box mt-2">
                @if(count($courses)>0)
                <ul class="list-group list-group-flush">
                    @foreach ($courses as $course)
                    <li class="list-group-item d-flex flex-row justify-content-between align-items-center">
                        <p class="m-0 p-0">{{ $course->course_name }}</p>
                        <div class="body-buttons d-flex flex-row justify-content-end align-items-center">
                            <button class="btn btn-custom d-flex flex-row align-items-center open_edit_course_modal" type="button"  data-course-edit-id="{{ $course->id }}"  data-course-edit-name="{{ $course->course_name }}">
                                <img src="/images/edit.png" alt="">
                                <small class="m-0 ms-2 p-0 font-nun d-none d-md-flex">Edit</small>
                            </button>
                            <button class="btn btn-custom d-flex flex-row align-items-center open_delete_course_modal" type="button" data-course-delete-id="{{ $course->id }}" data-course-delete-name="{{ $course->course_name }}" >
                                <img src="/images/delete.png" alt="">
                                <small class="d-none d-md-flex m-0 ms-2 p-0 font-nun">Delete</small>
                            </button>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="text-center">There's no courses inputted yet.</div>
                @endif
            </div>
            
        </section>
    </div> 
    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
    <!-- TODO scripts -->
    <script>
        var links = document.querySelectorAll('.navigation a');

        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var target = this.getAttribute('href');
                var offset = document.querySelector(target).offsetTop - 100;

                window.scrollTo({
                top: offset,
                behavior: 'smooth'
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-form-btn').click(function() {
                var form_id = $(this).data('formid');
                $('#form_id').val(form_id);
            });
        });
    </script>
@endsection