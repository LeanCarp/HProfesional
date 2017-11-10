$(document).ready(function() {

    // page is now ready, initialize the calendar...
   // $('body').append('<div id="calendario"></div>');
   moment.locale('es');
    $('#calendarioHistorial').fullCalendar({
        
       
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
                    url: 'historial/get_eventsSeleccion',
                    dataType: 'json',
                    cache: false,
                    lazyFetching:true,
                    type: 'GET',
                    data:{ // a function that returns an object
                        id : $("#selectNadadores option:selected").val()
                    ,
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
            
            window.location.href = 'entrenamiento/index/edit/'+  calEvent.id;
        }
        
                // put your options and callbacks here
    })
        $('#selectNadadores').change(function(){
           $('#calendarioHistorial').fullCalendar('refetchEvents');
        });
});