@extends ('layouts.main')

@section ('main_content')
    @include ('home_views.main-nav')
    <div data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="0" class="scrollspy-page" tabindex="0">
        @include ('home_views.body-header')
        @include ('home_views.body-sec-services')
        {{-- @include ('home_views.body-sec-news')
        @include ('home_views.body-sec-offers') --}}
        @include ('home_views.body-sec-history')
        @include ('home_views.body-sec-people')
        @include ('home_views.body-sec-partners')
        @include ('home_views.body-sec-contacts')
        @include ('shared_views.footerbar')
     </div>
@endsection
