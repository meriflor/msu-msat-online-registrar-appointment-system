var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
        left:'prev,next today',
        right:'title'
    },
    editable: false,
    businessHours: {
        dow: [1,2,3,4,5], 
        start: '08:00',
        end: '17:00',
    },
    selectConstraint: {
        dow: [1, 2, 3, 4, 5] 
    },
    events:'/appointment_slots',
    selectable:true,
    selectHelper: true,
    select: function(date, jsEvent, view, event){
        //review =============================Code for not disabled day=========================================
        var events = $('#calendar').fullCalendar('clientEvents');
        var event = events.find(e => moment(e.start).isSame(date, 'day'));
        var jsDate = date.toDate();
        var currentDate = new Date();
        var date = moment(date).format("YYYY-MM-DD");
        if(event){
            var url = '/dashboard-admin-appointments/request/'+ date;
            console.log(url);
            window.location.href = url;
        } 
    },
    eventRender: function(event, element) {
        if (event.slots === 0) { //if disabled,, appointment slots == 0 as default sa db
            console.log(event.slots);
            element.css('display', 'none');
            var cell = $(`.fc-bg td[data-date="${event.start.format('YYYY-MM-DD')}"]`);
            cell.addClass('fc-disabled-01');
        }if(event.currentSlot !== event.slots){
            element.addClass('fc-event-available');
        }else{
            element.addClass('fc-event-full');
        }
    },
    dayRender: function(date, cell, event) {
        var currentDate = new Date();
        if (date < currentDate) {
            $(cell).addClass('fc-disabled');
        }
        if ($(cell).hasClass('fc-disabled')) {
            return;
        }
    }
});