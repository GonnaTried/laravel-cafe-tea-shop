@extends('admin.layout.index')

@section('title', 'Create New User')

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">Create New User</h1>

        <div class="box">

            {{-- Form to create a new user --}}
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Phone Number --}}
                <div class="field">
                    <label class="label" for="phone">Phone <span class="has-text-danger">*</span></label>
                    <div class="control">
                        {{-- Input field for phone --}}
                        <input class="input @error('phone') is-danger @enderror" type="text" name="phone"
                            id="phone" value="{{ old('phone') }}" required autofocus>
                    </div>
                    @error('phone')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field">
                    <label class="label" for="password">Password <span class="has-text-danger">*</span></label>
                    <div class="control">
                        {{-- Input field for password --}}
                        <input class="input @error('password') is-danger @enderror" type="password" name="password"
                            id="password" required>
                    </div>
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- You can add more fields here if you add more columns to your 'users' table --}}
                {{-- For example, confirm password if you want client-side confirmation --}}
                {{-- <div class="field">
                    <label class="label" for="password_confirmation">Confirm Password <span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div> --}}


                {{-- Submit and Cancel Buttons --}}
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">Create User</button>
                    </div>
                    <div class="control">
                        {{-- Cancel Button Route --}}
                        <a href="{{ route('admin.users.index') }}" class="button is-link is-light">Cancel</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection
