$('.view-btn-pop').on('click', function() {
    var payment_id = $(this).attr('id');
    
    $.ajax({
        url: '/payments/' + payment_id,
        method: 'GET',
        success: function(data) {
            $('#referenceNum').text(data.reference_number);
            $('#viewProofOfPayment_cashier').attr('src', url + '/' + data.proof_of_payment);
            $('#confirmedPayment').text(data.confirmed_payment_remarks);
            
            $('#proof_of_payment_modal').modal('show');
            $('#pop_new_tab').on('click', function(){
                window.open(url + '/' + data.proof_of_payment, '_blank');
            });
        }
    });
});