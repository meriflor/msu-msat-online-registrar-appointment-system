@extends('admin-dashboard.admin')

@section('content')
    <!-- header -->
    <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn d-flex flex-row align-items-center" id="menu-btn">
            <img src="/images/back-arrow.png" alt="" />
            <p class="m-0 p-0 font-nun fs-6 ms-2" id="page-title">
                FAQ's
            </p>
        </a>
    </div>

<div class="d-flex flex-column">
    <div id="faqs-head" class="w-100 px-5 d-flex flex-row justify-content-between align-items-center">
        <div class="title font-nun font-bold fs-3">Frequently Ask Question's (FAQs)</div>
        <button class="btn btn-custom d-flex flex-row align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#addFaqsModal">
            <div class="logo">
                <img src="/images/add.png" alt="" />
            </div>
            <small class="m-0 ms-2 p-0 font-nun">Add</small>
        </button>
    </div>
    <div id="faqs-body" class="this-box mt-2">
        <div class="accordion" id="faqs-list">
            @foreach ($faqs as $faq)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button d-flex flex-row" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $faq->id }}" aria-expanded="false" aria-controls="1">
                        <div class="d-flex flex-column align-items-start">
                            <div>{{ $faq->faqs_title }}</div>
                            <small class="m-0 p-0"
                                >Posted on: {{ $faq->created_at }}</small>
                        </div>
                    </button>
                </h2>
                <div id="{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqs-list">
                    <div class="accordion-body d-flex flex-column">
                        <div class="body-content">
                            <pre>
                                {{ $faq->faqs_subtext }}
                            </pre>
                        </div>
                        <div
                            class="body-buttons d-flex flex-row justify-content-end mt-2">
                            <button class="btn btn-custom d-flex flex-row align-items-center open_edit_faq_modal"type="button" data-faq-edit-id="{{ $faq->id }}">
                                <img src="/images/edit.png" alt="" />
                                <small class="m-0 ms-2 p-0 font-nun">Edit</small>
                            </button>

                            <button
                                class="btn btn-custom d-flex flex-row align-items-center  open_delete_faq_modal"
                                type="button" 
                                data-faq-delete-id="{{ $faq->id }}" 
                                data-faq-delete-name="{{ $faq->faqs_title }}"
                            >
                                <img src="/images/delete.png" alt="" />
                                <small class="m-0 ms-2 p-0 font-nun"
                                    >Delete</small
                                >
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
@endsection