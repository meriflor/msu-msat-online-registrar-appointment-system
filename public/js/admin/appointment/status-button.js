// accept button
$(document).ready(function(){
    $('.accept-btn').on('click', function(){
        $('#status_appointment_modal').modal('show');
        var accept_id = $(this).data('accept-id');
        console.log(accept_id);
        $('#status_appointment_modal').find('#app_id').val(accept_id);
        $('#status_appointment_modal').find('#status_title').text("Commence Processing");
        $('#status_appointment_modal').find('#status_body').text("This will inform the user that their request is now being processed.");
        $('#readytoclaim_sect').hide();
        $('#acceptApp').show();
        $('#doneApp').hide();
        $('#claimedApp').hide();
    });
    $('.done-btn').on('click', function(){
        var done_id = $(this).data('done-id');
        console.log(done_id);
        $('#status_appointment_modal').find('#app_id').val(done_id);
        $('#status_appointment_modal').find('#status_title').text("Process Completed");
        $('#status_appointment_modal').find('#status_body').text("Confirm process being completed?");
        $('#readytoclaim_sect').show();
        $('#acceptApp').hide();
        $('#doneApp').show();
        $('#claimedApp').hide();
    });
    $('.claimed-btn').on('click', function(){
        var claimed_id = $(this).data('claimed-id');
        console.log(claimed_id);
        $('#status_appointment_modal').find('#app_id').val(claimed_id);
        $('#status_appointment_modal').find('#status_title').text("Claimed Document");
        $('#status_appointment_modal').find('#status_body').text("Confirm document has been claimed?");
        $('#readytoclaim_sect').hide();
        $('#acceptApp').hide();
        $('#doneApp').hide();
        $('#claimedApp').show();
    });
});

// fix find == if not used, delete
$(document).ready(function(){
    $('.status').each(function() {
        var status = $(this).text();
        var $td = $(this).closest('td');
        var $buttons = $(this).parent().find('.btn');
        if(status === "Pending"){
            $td.css('background-color', '#ffecb3');
            $buttons.filter('#accept-btn').show();
            $buttons.filter('#done-btn').hide();
            $buttons.filter('#claimed-btn').hide();
        } else if(status === "On Process"){
            $td.css('background-color', '#c0deff');
            $buttons.filter('#accept-btn').hide();
            $buttons.filter('#done-btn').show();
            $buttons.filter('#claimed-btn').hide();
        } else if(status === "Ready to Claim"){
            $td.css('background-color', '#dcffe4');
            $buttons.filter('#accept-btn').hide();
            $buttons.filter('#done-btn').hide();
            $buttons.filter('#claimed-btn').show();
        }else{
            $buttons.filter('#accept-btn').hide();
            $buttons.filter('#done-btn').hide();
            $buttons.filter('#claimed-btn').hide();
        }
    });
});
