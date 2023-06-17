$('.remarks-btn').on('click', function(){
    $('#remarks_modal').modal('show');
    var remarks_id = $(this).data('remarks-id');
    var first_name = $(this).data('remarks-first');
    var last_name = $(this).data('remarks-last');
    var doc_name = $(this).data('remarks-form');
    var remarks_type = $(this).data('remarks-type');
    $('#remarks_modal').find('#app_id').val(remarks_id);
    $('#remarks_modal').find('#first_name').text(first_name);
    $('#remarks_modal').find('#last_name').text(last_name);
    $('#remarks_modal').find('#doc_name').text(doc_name);
    $('#remarks_modal').find('#doc').val(doc_name);
    if(remarks_type === "reupload")
        $('#remarks_modal').find('#title_reupload_req').show();
});