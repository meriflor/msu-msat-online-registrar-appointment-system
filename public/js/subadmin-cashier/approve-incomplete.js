$('.approve-payment-btn').on('click', function() {
    var payment_id = $(this).data('payment_id');
    $('#approve_payment_modal').modal('show');
    $('#approve_payment_modal').find('#payment_id').val(payment_id);
});

//fix not needed for now
$('.incomplete-payment-btn').on('click', function() {
    var app_id = $(this).data('app-id');
    $('#incomplete_payment_modal').modal('show');
    $('#incomplete_payment_modal').find('#app_id').val(app_id);
});

$('.view-remarks-incomplete').on('click', function() {
    var id = $(this).data('app-id');
    console.log(id);
    fetch('/incomplete-remarks/' + id)
        .then(response => response.json())
        .then(data => {
            $('#incomplete_remarks_modal').modal('show');
            $('#incomplete_remarks_modal').find('#incomplete_remarks').text(data.remarks);
    });
});