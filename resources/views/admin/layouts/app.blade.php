@extends('admin.layouts.master')

@section('leftmenu')
    @include('admin.includes.leftmenu', ['package_name' => "uzaweb/openexam"])
@endsection

@push('package-styles')
    <!-- Openexam package-styles -->
    {{ style(@mixcdn('css/bootstrap.css', 'vendor/rvsitebuilder/wysiwyg')) }}
    {{ style(@mixcdn('css/commons.css', 'vendor/rvsitebuilder/wysiwyg')) }}

@endpush

@push('package-scripts')
    <!-- Openexam package-scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
         integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" 
         crossorigin="anonymous"></script>


@endpush

