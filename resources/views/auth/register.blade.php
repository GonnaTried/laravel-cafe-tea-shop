@extends('frontend.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title">Register</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
