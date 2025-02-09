@extends('frontend.master')

@section('title', 'Location')

@section('content')
    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="title">Our Location</h1>
            </div>

            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.179819379086!2d104.89473147469484!3d11.568086064942176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095173761d4a53%3A0xcd09ff2f4d326e3f!2sSETEC%20Institute!5e0!3m2!1sen!2skh!4v1715248747749!5m2!1sen!2skh"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>


            <div class="columns">
            </div>
        </div>
    </section>
@endsection
