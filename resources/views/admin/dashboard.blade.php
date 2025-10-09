

{{--@extends('admin.app')--}}
{{--@section('admin_content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="page-title-box">--}}
{{--                <div class="page-title-right">--}}
{{--                    <ol class="breadcrumb m-0">--}}
{{--                        <li class="breadcrumb-item"><a href="#">Luxury Chauffeur</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="#">Dashboards</a></li>--}}
{{--                        <li class="breadcrumb-item active">Booking Calendar</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--                <h4 class="page-title">Booking Calendar</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- FullCalendar CSS/JS -->--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>--}}

{{--    <style>--}}
{{--        /* Force event text to black */--}}
{{--        .fc .fc-event,--}}
{{--        .fc .fc-event * {--}}
{{--            color: #000 !important;--}}
{{--        }--}}

{{--        .fc .fc-event .fc-event-title,--}}
{{--        .fc .fc-event .fc-event-time {--}}
{{--            color: #000 !important;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <div id="bookingCalendar"></div>--}}

{{--    <!-- Booking Info Modal -->--}}
{{--    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-primary text-white">--}}
{{--                    <h5 class="modal-title">Booking Details</h5>--}}
{{--                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <p><strong>Booking:</strong> <span id="modalBookingTitle"></span></p>--}}
{{--                    <p><strong>Pickup:</strong> <span id="modalPickup"></span></p>--}}
{{--                    <p><strong>Drop:</strong> <span id="modalDrop"></span></p>--}}
{{--                    <p><strong>Fleet:</strong> <span id="modalFleet"></span></p>--}}
{{--                    <p><strong>Adults:</strong> <span id="modalAdults"></span></p>--}}
{{--                    <p><strong>Phone:</strong> <span id="modalPhone"></span></p>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            var calendarEl = document.getElementById('bookingCalendar');--}}

{{--            var calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                initialView: 'dayGridMonth',--}}
{{--                height: 700,--}}
{{--                themeSystem: 'bootstrap5',--}}
{{--                headerToolbar: {--}}
{{--                    left: 'prev,next today',--}}
{{--                    center: 'title',--}}
{{--                    right: 'dayGridMonth,timeGridWeek' // Only Month & Week--}}
{{--                },--}}
{{--                buttonText: {--}}
{{--                    today: 'Today',--}}
{{--                    month: 'Month',--}}
{{--                    week: 'Week'--}}
{{--                },--}}
{{--                events: '/bookings/calendar',--}}
{{--                eventDidMount: function(info) {--}}
{{--                    info.el.style.color = '#000';--}}
{{--                    var title = info.el.querySelector('.fc-event-title');--}}
{{--                    if (title) title.style.color = '#000';--}}
{{--                    var time = info.el.querySelector('.fc-event-time');--}}
{{--                    if (time) time.style.color = '#000';--}}

{{--                    if (info.event.backgroundColor) {--}}
{{--                        info.el.style.backgroundColor = info.event.backgroundColor;--}}
{{--                    }--}}
{{--                    if (info.event.borderColor) {--}}
{{--                        info.el.style.borderColor = info.event.borderColor;--}}
{{--                    }--}}
{{--                },--}}
{{--                eventClick: function(info) {--}}
{{--                    let props = info.event.extendedProps;--}}
{{--                    document.getElementById('modalBookingTitle').textContent = info.event.title;--}}
{{--                    document.getElementById('modalPickup').textContent = props.pickup;--}}
{{--                    document.getElementById('modalDrop').textContent = props.drop;--}}
{{--                    document.getElementById('modalFleet').textContent = props.fleet;--}}
{{--                    document.getElementById('modalAdults').textContent = props.adults;--}}
{{--                    document.getElementById('modalPhone').textContent = props.phone;--}}
{{--                    var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));--}}
{{--                    bookingModal.show();--}}
{{--                }--}}
{{--            });--}}

{{--            calendar.render();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}



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

    <!-- FullCalendar CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <style>
        /* Booking event style */
        .fc-event {
            background-color: #28a745 !important; /* Bootstrap green */
            border: none !important;
            color: #fff !important;
            text-align: center !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            white-space: normal !important; /* wrap text */
            font-size: 12px !important;
            line-height: 14px !important;
            padding: 4px !important;
            border-radius: 6px !important;
        }
        .fc .fc-event-title {
            font-weight: bold;
        }
    </style>

    <div id="bookingCalendar"></div>

    <!-- Booking Info Modal -->
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
                    right: 'dayGridMonth,timeGridWeek' // Month + Week only
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week'
                },
                events: '/bookings/calendar',

                // Show booking details inside each event
                eventContent: function(arg) {
                    let props = arg.event.extendedProps;
                    let customHtml = `
                        <div style="width:100%;">
                            <b>${arg.event.title}</b><br>
                            Pickup: ${props.pickup}<br>
                            Drop: ${props.drop}<br>
                            Fleet: ${props.fleet}<br>
                            Adults: ${props.adults}<br>
                            Phone: ${props.phone}
                        </div>
                    `;
                    return { html: customHtml };
                },

                // Modal click event
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
