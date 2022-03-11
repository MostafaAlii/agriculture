@extends('front.layouts.master')
@section('title', 'Maintenance  ')
@section('css')

@endsection
@section('content')
    <!-- start section -->
    <section class="section section--no-pb section--custom-01">
        <div class="container">
            <div class="section-heading">
                <h2 class="__title">the site in a maintenance time </h2>
                {{setting()->message_maintenance}}
            </div>


        </div>
    </section>


@endsection
@push('js')

@endpush
