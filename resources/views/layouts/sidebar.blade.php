@if( Auth::user()->user_type_id == "1" )
    @include('layouts.customersidebar')
@else
    @include('layouts.expertsidebar')
@endif
