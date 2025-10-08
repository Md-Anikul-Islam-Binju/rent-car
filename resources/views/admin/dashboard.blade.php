@extends('admin.app')
@section('admin_content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Luxury Chauffeur</a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                            <li class="breadcrumb-item active">Booking Calendar</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Booking Calendar</h4>
                </div>
            </div>
        </div>
    <!-- include FullCalendar CSS/JS (already used) -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <style>
        /* Force event text to black (important to override theme) */
        .fc .fc-event,
        .fc .fc-event * {
            color: #000 !important;
        }

        /* More specific rules for title/time */
        .fc .fc-event .fc-event-title,
        .fc .fc-event .fc-event-time {
            color: #000 !important;
        }
    </style>

    <div id="bookingCalendar"></div>

    <!-- Booking Info Modal (same as before) -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Booking Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Booking:</strong> <span id="modalBookingTitle"></span></p>
                    <p><strong>Pickup:</strong> <span id="modalPickup"></span></p>
                    <p><strong>Drop:</strong> <span id="modalDrop"></span></p>
                    <p><strong>Fleet:</strong> <span id="modalFleet"></span></p>
                    <p><strong>Adults:</strong> <span id="modalAdults"></span></p>
                    <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('bookingCalendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 700,
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/bookings/calendar',
                // This ensures inline styles are applied when the event element mounts
                eventDidMount: function(info) {
                    // Force color inline to beat any CSS specificity from the theme
                    info.el.style.color = '#000'; // fallback for whole element
                    // title/time are sometimes nested — set them explicitly
                    var title = info.el.querySelector('.fc-event-title');
                    if (title) title.style.color = '#000';
                    var time = info.el.querySelector('.fc-event-time');
                    if (time) time.style.color = '#000';

                    // ensure background/border match server-sent values if present
                    if (info.event.backgroundColor) {
                        info.el.style.backgroundColor = info.event.backgroundColor;
                    }
                    if (info.event.borderColor) {
                        info.el.style.borderColor = info.event.borderColor;
                    }
                },
                eventClick: function(info) {
                    let props = info.event.extendedProps;
                    document.getElementById('modalBookingTitle').textContent = info.event.title;
                    document.getElementById('modalPickup').textContent = props.pickup;
                    document.getElementById('modalDrop').textContent = props.drop;
                    document.getElementById('modalFleet').textContent = props.fleet;
                    document.getElementById('modalAdults').textContent = props.adults;
                    document.getElementById('modalPhone').textContent = props.phone;
                    var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                    bookingModal.show();
                }
            });

            calendar.render();
        });
    </script>

@endsection
