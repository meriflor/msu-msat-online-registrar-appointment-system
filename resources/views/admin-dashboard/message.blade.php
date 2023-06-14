@extends('admin-dashboard.admin')

@section('content')
    <!-- header -->
    <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn d-flex flex-row align-items-center" id="menu-btn">
            <img src="/images/back-arrow.png" alt="" />
            <p class="m-0 p-0 font-nun fs-6 ms-2" id="page-title">
                Message
            </p>
        </a>
    </div>

    <div class="container">
        @if (count($messages) > 0)
            @foreach ($messages as $msg)
                <div class="notification p-4 mb-4">
                    <div class="d-flex flex-column align-items-start">
                        <div class="d-flex flex-column justify-content-center">
                            <h5 class="m-0 me-2">
                                <span class="font-bold">{{ $msg->fullname }}</span>
                            </h5>
                            <small>{{ $msg->email }}</small>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <small> {{ $msg->created_at->diffForHumans() }}
                                <span>
                                    <a style="color: #1e1e1e;" data-bs-toggle="collapse" href="#{{ $msg->id }}"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        View Message
                                    </a>
                                </span>
                            </small>
                        </div>
                    </div>

                    <div class="collapse" id="{{ $msg->id }}">
                        <p class="px-5 py-4">{{ $msg->message }}</p>
                        <div class="d-flex flex-row justify-content-end">
                            <button class="btn notif-btn delete-button" data-message-id="{{ $msg->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="d-flex flex-row justify-content-center align-items-center font-nun">
                <h5>We didn't receive any message yet.</h5>
            </div>
        @endif
    </div>


    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header font-white">
                    <h5 class="modal-title" id="delete-modal-title">Confirmation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this message?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-custom ms-3" id="confirm-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>

    <script>
        $('.delete-button').click(function(e) {
            // e.stopPropagation();

            // Retrieve the message ID from the data attribute
            var messageId = $(this).data('message-id');

            // Display the confirmation modal
            $('#delete-modal').modal('show');

            // Confirm delete action
            $('#confirm-delete-btn').click(function() {
                // Make an AJAX request to delete the message
                $.ajax({
                    url: '/messages/' + messageId,
                    method: 'DELETE',
                    success: function(response) {
                        // Handle successful deletion
                        // For example, you can show a success message or perform any other necessary action
                        $('#delete-modal').modal(
                            'hide'); // Hide the confirmation modal
                        location.reload(); // Refresh the page
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
