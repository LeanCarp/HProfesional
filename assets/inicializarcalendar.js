$(document).ready(function() {

    // page is now ready, initialize the calendar...
   // $('body').append('<div id="calendario"></div>');
   moment.locale('es');
    $('#calendario').fullCalendar({
        
       
       // events: [{"id":"14","title":"Evento prueba","start":"2017-10-24T16:00:00+04:00","allDay":false}],
        header: {
        
                left:   'today prev,next',
                center: 'title',
                right:  'month,basicWeek,basicDay' 
             // buttons for switching between views
        },
        eventSources: [
            {
                events: function(start, end, timezone, callback) {
                    $.ajax({
                    url: 'calendar/get_events',
                    dataType: 'json',
                    data: {
                    // our hypothetical feed requires UNIX timestamps
                    start: start.unix(),
                    end: end.unix()
                    },
                    success: function(msg) {
                        var events = msg.events;
                        callback(events);
                    },
                    
                    });
                }
            },
            
        ],
        eventClick: function(calEvent, jsEvent, view) {

            //Si es un campeonato
            if(calEvent.title.charAt(0)=='C') 
            {
                window.location.href = 'campeonato/index/edit/'+  calEvent.id;
            }
            //Si es un entrenamiento
            else
            {
                window.location.href = 'entrenamiento/index/edit/'+  calEvent.id;
            }

            //Codigo de prueba de la documentacion
             /*    
                    alert('Event: ' + calEvent.title);
                    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    alert('View: ' + view.name);           
                    // change the border color just for fun
                    $(this).css('border-color', 'red');
            */
                }
        
        // put your options and callbacks here
    })

});