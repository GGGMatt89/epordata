{{-- @component('mail::message')
# Agenda appuntamenti di oggi

@foreach($scheduleArray as $meeting)
- {{$meeting}}
@endforeach
@component('mail::button', ['url' => config('app.url'), 'color' => 'gradient'])
Visita epordata.it
@endcomponent

A domani,<br>
{{ config('app.name') }}
@endcomponent --}}

@component('mail::message')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
        @endcomponent
    @endslot

    {{-- Body --}}
# Richiesta di contatto
{{$email_body}}

{{-- @component('mail::button', ['url' => config('app.url'), 'color' => 'gradient'])
Visita epordata.it
@endcomponent --}}

A presto,<br>
{{ config('app.name') }}
    {{-- Subcopy
    @slot('subcopy')
        @component('mail::subcopy')
            <!-- subcopy here -->
        @endcomponent
    @endslot --}}


    {{-- Footer --}}
    {{-- @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot --}}
@endcomponent

