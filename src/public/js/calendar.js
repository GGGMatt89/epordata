function renderCalendar() {
    var events = [];
    array_events.forEach(function(data, index) { 
        events.push({
            title: data.customer,
            start: data.scheduled_at,
            description: data.notes
        })
    });
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'it';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap' ],
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
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        locale: initialLocaleCode,
        buttonIcons: true, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: events
    });

    calendar.render();

    });
}
