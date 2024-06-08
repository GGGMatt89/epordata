let col_obj = {
    'past': 'rgb(255, 128, 128)',
    'future': 'rgb(254, 3, 3)',
    'pastHover': 'rgb(33, 54, 82)',
    'futureHover': 'rgb(5, 32, 66)',
    'pastRemote': 'rgb(124, 222, 122)',
    'futureRemote': 'rgb(6, 227, 2)',
    'pastRemoteHover': 'rgb(97, 171, 96)',
    'futureRemoteHover': 'rgb(5, 184, 2)',
};

function prepareMeetings(meetings, col_obj, today){
    let events = [];
    meetings.forEach(function(data, index) {
        let meet_date = new Date(data.scheduled_at);
        let feat = (meet_date > today) ? 'future' : 'past';
        console.log(meet_date);
        if(data.remote){
            feat = feat + 'Remote';
        }
        events.push({
            id: data.id,
            title: data.cust_surname,
            start: data.scheduled_at,
            description: data.meet_address,
            color: col_obj[feat]
        })
    });
    return events;
}

let selectMeetings = function(fetchInfo, successCallback, failureCallback){
    let events = [];
    let id = setId;
    let selector = document.getElementById('user_id');
    if(selector){
        id = selector.value;
    }
    if(id == ' '){
        array_events.forEach(function(data, index) {
            let meet_date = new Date(data.scheduled_at);
            let feat = (meet_date > today) ? 'future' : 'past';
            if(data.remote){
                feat = feat + 'Remote';
            }
            events.push({
                id: data.id,
                title: data.cust_surname + ' [' + data.user_lastname + ' ' + data.user_name + ']',
                start: data.scheduled_at,
                description: data.meet_address,
                color: col_obj[feat]
            });
        });
    }
    else{
        array_events.forEach(function(data, index) {
            if(id && id == data.user_id){
                let meet_date = new Date(data.scheduled_at);
                // let end_date = meet_date.setHours(meet_date.getHours() + 1);
                let feat = (meet_date > today) ? 'future' : 'past';
                if(data.remote){
                    feat = feat + 'Remote';
                }
                events.push({
                    id: data.id,
                    title: data.cust_surname,
                    start: data.scheduled_at,
                    // end: end_date,
                    description: data.meet_address,
                    color: col_obj[feat]
                })
            }
        });
    }
    successCallback(events);
    // return events;
}

function createCalendar(calendarEl, colors){
    let initialLocaleCode = 'it';
    let calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
        defaultView: 'timeGridWeek',
        themeSystem: 'bootstrap',
        buttonText: {
            today: 'oggi',
            month: 'mese',
            week: 'settimana',
            day: 'giorno',
            list: 'lista',
            prev: 'prec',
            next: 'succ',
        },
        bootstrapFontAwesome: {
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            prevYear: 'fa-angle-double-left',
            nextYear: 'fa-angle-double-right'
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: initialLocaleCode,
        buttonIcons: true, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        nowIndicator: true,
        eventLimit: true, // allow "more" link when too many events
        // events: events,
        eventSources: [
            {
                events: selectMeetings
            }
        ],
        // eventRender: function(info) {
        //     var content = "<strong>Appuntamento presso </strong>" + info.event.title + "<br> <strong>Sede: </strong>" + info.event.extendedProps.description;
        //     $(info.el).tooltip({
        //         title:  content,
        //         container: 'body',
        //         placement: 'top',
        //         trigger: 'hover',
        //         html: true
        //     });
        // },
        eventClick: function(info) {
            let id = info.event.id
            // let url = '{{ route("meeting.show", ":id") }}';
            let url = 'meeting/' + id;
            // url = url.replace(':id', id);
            document.location.href=url;
        },
        eventMouseEnter: function(info){
            // change the background color
            if(info.el.style.backgroundColor == colors['future']){
                info.el.style.backgroundColor = colors['futureHover'];
            }
            if(info.el.style.backgroundColor == colors['past']){
                info.el.style.backgroundColor = colors['pastHover'];
            }
            if(info.el.style.backgroundColor == colors['futureRemote']){
                info.el.style.backgroundColor = colors['futureRemoteHover'];
            }
            if(info.el.style.backgroundColor == colors['pastRemote']){
                info.el.style.backgroundColor = colors['pastRemoteHover'];
            }
        },
        eventMouseLeave: function(info) {
            // change the background color
            if(info.el.style.backgroundColor == colors['futureHover']){
                info.el.style.backgroundColor = colors['future'];
            }
            if(info.el.style.backgroundColor == colors['pastHover']){
                info.el.style.backgroundColor = colors['past'];
            }
            if(info.el.style.backgroundColor == colors['futureRemoteHover']){
                info.el.style.backgroundColor = colors['futureRemote'];
            }
            if(info.el.style.backgroundColor == colors['pastRemoteHover']){
                info.el.style.backgroundColor = colors['pastRemote'];
            }
        }
    });
    return calendar;
}
