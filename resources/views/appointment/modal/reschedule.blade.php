
<form action="{{ route('reschedule') }}" method="post">
        @method('PUT')
        @csrf
<div
    class="modal fade"
    id="re_sched_modal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun">
                    Re-Schedule
                </h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body font-nun px-5">
                    <input type="hidden" id="re_app_id" name="re_app_id">
                    <input type="hidden" id="re_app_date_input" name="re_app_date_input">
                    <div class="d-flex flex-row flex-wrap">
                        <b>Selected Date:</b><p id="re_app_date" class="ms-2">Select a date first.</p>
                    </div>
                    <div class="d-flex flex-row notice-box p-3" id="exp_sect">
                        <p class="m-0"><b>Reminder: </b>The <span id="re_form_name"></span> maximum time to claim is <span id="re_exp_date"></span> upon approving the request</p>
                    </div>
                    <div class="d-flex flex-row flex-wrap justify-content-end mt-2">
                        <div class="full-sect mx-2 d-flex flex-row align-items-center">
                            <div class="legend-box fc-event-full me-1"></div>
                            <div>Full</div>
                        </div>
                        <div class="avai-sect mx-2 d-flex flex-row align-items-center">
                            <div class="legend-box fc-event-available me-1"></div>
                            <div>Available</div>
                        </div>
                    </div>
                    <div id="calendar_01" class="mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-custom"
                        data-bs-dismiss="modal"
                        id=""
                    >
                        Dissmis
                    </button>
                    <button id="resched_btn_submit" type="submit" class="btn btn-custom ms-2">
                        Update
                    </button>
            </div>
        </div>
    </div>
</div>
</form>

<script>
    // var appointment_date;
    // $(document).ready(function() { 
    //     $('#calendar_01').fullCalendar({
    //         editable:true,
    //         header:{
    //             left:'prev,next today',
    //             right:'title'
    //         },
    //         editable: false,
    //         businessHours: {
    //             dow: [1,2,3,4,5], // Monday - Friday only
    //             start: '08:00',
    //             end: '17:00',
    //         },
    //         selectConstraint: {
    //             dow: [1, 2, 3, 4, 5] // The days of the week when selections are allowed
    //         },
    //         events:'/appointment_slots',
    //         selectable:true,
    //         selectHelper: true,
    //         select: function(date, jsEvent, view, event, element){
    //             var events = $('#calendar').fullCalendar('clientEvents');
    //             var event = events.find(e => moment(e.start).isSame(date, 'day'));
    //             var jsDate = date.toDate();
    //             var new_date;
                
    //             if (event && (event.isDisabled || event.status === "Full")) {
    //                 // alert("Full or disabled");
    //             } else if (!event){
    //                 //kasni is gicheck nya if naa bay event aning mga adlawa,, like naa bay naset na appointment ang admin,, if wala then return false
    //                 return false;
    //             } else {
    //                 var new_cell;
    //                 if(!appointment_date){
    //                 //if wa pay sulod, magset syag appointment
    //                     cell = $(`.fc-bg td[data-date="${date.format('YYYY-MM-DD')}"]`);
    //                     appointment_date = moment(date).format('MMMM DD, YYYY');
    //                     console.log('Appointment date:', appointment_date);
    //                     alert(appointment_date + " is your appointment date");
    //                     cell.addClass('fc-selected-date');
    //                     $('#re_app_date').text(appointment_date);
    //                     $('#re_app_date_input').val(appointment_date);
    //                     event.title = "Selected";
    //                 }
    //                 /*else, icompare nya ang new date nga iyng giclick sa current naset 
    //                 na appointment date,, if same sya way laing himoon*/
    //                 new_date = moment(event.start).format('MMMM DD, YYYY');
    //                 new_cell = $(`.fc-bg td[data-date="${date.format('YYYY-MM-DD')}"]`);
    //                 if(new_date === appointment_date){
    //                     return false;
    //                 }
    //                 //else, ichange nya ang appointment date sa new date
    //                 alert("Do you want to change your appointment date to " + new_date + " ?")
                    
    //                 cell.removeClass('fc-selected-date');
    //                 appointment_date = new_date;
    //                 cell = new_cell;
    //                 cell.addClass('fc-selected-date');
    //                 $('#re_app_date').text(appointment_date);
    //                 $('#re_app_date_input').val(appointment_date);
    //                 console.log(appointment_date + " is now your new appointment date");
    //             }
    //         },
    //         eventRender: function(event, element) {
    //             if (event.slots === 0 || event.isDisabled === true) { //if disabled,, appointment slots == 0 as default
    //                 element.css('display', 'none');
    //                 var cell = $(`.fc-bg td[data-date="${event.start.format('YYYY-MM-DD')}"]`);
    //                 // cell.addClass('fc-disabled-01');
    //             }if(event.status === "Available"){
    //                 element.addClass('fc-event-available');
    //             }else{
    //                 element.addClass('fc-event-full');
    //             }
    //         },
    //         dayRender: function(date, cell, event) {
    //             var currentDate = new Date();//css,, disabled ang mga cell
    //             if (date < currentDate) {
    //                 $(cell).addClass('fc-disabled');
    //             }
    //             if ($(cell).hasClass('fc-disabled')) {
    //                 return;
    //             }if (date === appointment_date) {
    //                 $(cell).addClass('fc-selected-event');
    //             }
    //         }
    //     })
    // });

    $('.resched_btn').on('click', function(){
        var form_name = $(this).data('form-name');
        var form_max_time = $(this).data('form-max-claim');
        var app_id = $(this).data('app-id');
        $('#re_sched_modal').modal('show');
        $('#re_form_name').text(form_name);
        $('#re_exp_date').text(form_max_time);
        $('#re_app_id').val(app_id);
    });
    
     $('#resched_btn_submit').on('click', function(){
        if(appointment_date == null){
            alert('Please choose a date.')
            console.log(form_name);
            console.log(form_max_time);
            return false;
        }
    });
</script>
