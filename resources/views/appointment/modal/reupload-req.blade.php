<div
    class="modal fade"
    id="reupload_requirements_modal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun">
                    Re-upload Requirements
                </h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body font-nun px-5">
                    <input type="hidden" id="request_id" name="request_id">
                    <div id="" class="">
                        <div class="d-flex flex-column w-100 mb-3">
                            <p class="fs-4 font-mont font-bold">Upload Requirements</p>
                            <label for="inputRequirements01" class="form-label">Requirements</label>
                            <input type="file" class="form-control" id="inputRequirements01" name="requirements[]" multiple accept=".doc,.docx,.pdf,.jpg,.png,.jpeg,.svg" required>
                            <div id="selectedFiles01" class="p-3" style="-webkit-text-stroke-width: medium;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-custom"
                        data-bs-dismiss="modal"
                        id="dismiss_reupload_req"
                    >
                        Dissmis
                    </button>
                    <button id="requirements_submit" type="submit" class="btn btn-custom ms-2">
                        Update
                    </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#inputRequirements01').on('change', function() {
        var files = $(this)[0].files;
        var selectedFiles = '';
        for (var i = 0; i < files.length; i++) {
            selectedFiles += files[i].name + '<br>';
        }
        $('#selectedFiles01').html(selectedFiles);
    });
    $('.upload_req_button').on('click', function(){
        var app_id = $(this).data('app_id');
        $('#reupload_requirements_modal').modal('show');
        $('#reupload_requirements_modal').find('#request_id').val(app_id);
    });

    $('#dismiss_reupload_req').on('click', function(){
        $('input[type="file"]').val(null);
    });

    $('#requirements_submit').on('click', function(){
        var files = $('#inputRequirements01')[0].files;
        var request_id = $('#reupload_requirements_modal').find('#request_id').val();
        if (files.length === 0) {
            alert('Please upload your requirements.');
            return false;
        }
        console.log(request_id);
        var formData = new FormData();
        formData.append('request_id', request_id);
        for (var i = 0; i < files.length; i++) {
            formData.append('requirements[]', files[i]);
            console.log(files[i]);
        }

        $.ajax({
            url: "{{ route('requirements.upload') }}",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
