@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Class Calendar</h1>
    <div id="calendar"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: async function (fetchInfo, successCallback, failureCallback) {
                try {
                    const response = await fetch('{{ route("calendar.create") }}');
                    const data = await response.json();
                    successCallback(data.events);
                } catch (error) {
                    console.error('Error loading events:', error);
                    failureCallback(error);
                }
            },
            eventColor: '#3788d8',
            editable: false,
            eventDisplay: 'block',
        });

        calendar.render();
    });
</script>
@endsection
