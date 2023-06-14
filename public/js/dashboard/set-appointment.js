$(document).ready(function() {
    var appointment_date;
    $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            right:'title'
        },
        editable: false,
        businessHours: {
            dow: [1,2,3,4,5], // Monday - Friday only
            start: '08:00',
            end: '17:00',
        },
        selectConstraint: {
            dow: [1, 2, 3, 4, 5] // The days of the week when selections are allowed
        },
        events:'/appointment_slots',
        selectable:true,
        selectHelper: true,
        longPressDelay: 0,
        select: function(date, jsEvent, view, event, element){
            var events = $('#calendar').fullCalendar('clientEvents');
            var event = events.find(e => moment(e.start).isSame(date, 'day'));
            var jsDate = date.toDate();
            var new_date;
            var currentDate = new Date();
            
            if (event && (event.isDisabled || event.status === "Full")) {
                return false;
            } else if (!event){
                //kasni is gicheck nya if naa bay event aning mga adlawa,, like naa bay naset na appointment ang admin,, if wala then return false
                return false;
            } else if(event && date < currentDate){
                return false;
            }else {
                var new_cell;
                if(!appointment_date){
                //if wa pay sulod, magset syag appointment
                    cell = $(`.fc-bg td[data-date="${date.format('YYYY-MM-DD')}"]`);
                    appointment_date = moment(date).format('MMMM DD, YYYY');
                    console.log('Appointment date:', appointment_date);
                    alert(appointment_date + " is your appointment date");
                    cell.addClass('fc-selected-date');
                    $('#re_app_date').text(appointment_date);
                    event.title = "Selected";
                }
                /*else, icompare nya ang new date nga iyng giclick sa current naset 
                na appointment date,, if same sya way laing himoon*/
                new_date = moment(event.start).format('MMMM DD, YYYY');
                new_cell = $(`.fc-bg td[data-date="${date.format('YYYY-MM-DD')}"]`);
                if(new_date === appointment_date){
                    return false;
                }
                //else, ichange nya ang appointment date sa new date
                alert("Do you want to change your appointment date to " + new_date + " ?")
                
                cell.removeClass('fc-selected-date');
                appointment_date = new_date;
                cell = new_cell;
                cell.addClass('fc-selected-date');
                $('#re_app_date').text(appointment_date);
                console.log(appointment_date + " is now your new appointment date");
            }
        },
        eventRender: function(event, element) {
            if (event.slots === 0 || event.isDisabled === true) { //if disabled,, appointment slots == 0 as default
                element.css('display', 'none');
                var cell = $(`.fc-bg td[data-date="${event.start.format('YYYY-MM-DD')}"]`);
                // cell.addClass('fc-disabled-01');
            }if(event.status === "Available"){
                element.addClass('fc-event-available');
            }else{
                element.addClass('fc-event-full');
            }
        },
        dayRender: function(date, cell, event) {
            var currentDate = new Date();//css,, disabled ang mga cell
            if (date < currentDate) {
                $(cell).addClass('fc-disabled');
            }
            if ($(cell).hasClass('fc-disabled')) {
                return;
            }if (date === appointment_date) {
                $(cell).addClass('fc-selected-event');
            }
        }
    });

    $('.set_app_btn').on('click', function(){
        console.log('Clicked set app button');

        var app_id = $(this).data('app-id');
        $('#set_app_modal').modal('show');
        $('#re_app_id').val(app_id);
    });

    $('.dissmis_set_app_btn').on('click', function(){
        console.log('Clicked set app button');
        var appointment_date = null;
        console.log(appointment_date);
    });
    
     $('#appointment_submit').on('click', function(){
        if(appointment_date == null){
            alert('Please choose a date.')
            return false;
        }
        var request_id = $('#re_app_id').val();

        $.ajax({
            url: "{{ route('set.appointment') }}",
            method: "POST",
            data: {
                request_id: request_id,
                appointment_date: appointment_date
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            headers: {
                'X-HTTP-Method-Override': 'PUT' // Set the request method to PUT
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
