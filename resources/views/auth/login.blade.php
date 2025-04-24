@extends('frontend.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Login</h1>
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="container">
                            <div class="notification is-dark">

                                {{-- Displaying errors from the server --}}
                                @if ($errors->any())
                                    <div class="notification is-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Displaying success messages --}}
                                @if (session('success'))
                                    <div class="notification is-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <label class="title is-4 has-text-white">Phone Number</label>
                                <input class="input @error('phone') is-danger @enderror" type="text" name="phone"
                                    id="email_phone" placeholder="012xxxxxxx" value="{{ old('phone') }}" />
                                @error('phone')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                                <br>
                                <br>

                                <label class="title is-4 has-text-white">Password</label>
                                <input class="input @error('password') is-danger @enderror" type="password" name="password"
                                    id="password" placeholder="#1245ksde$$" value="{{ old('password') }}" />
                                @error('password')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                                <br>
                                <br>

                                <div class="field is-centered">
                                    <div class="column has-text-centered">
                                        <button class="button is-primary" type="submit">Login</button>
                                    </div>
                                    <div class="column has-text-centered">
                                        <h3>Don't have account yet?</h3>
                                        {{-- Make this button a link to the registration page --}}
                                        <a href="{{ route('register') }}" class="button is-primary">Register Here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form');
            const emailPhoneInput = document.getElementById('email_phone');
            const passwordInput = document.getElementById('password');

            emailPhoneInput.addEventListener('blur', function() {

                // Validate Email/Phone
                if (emailPhoneInput.value === '') {
                    emailPhoneInput.classList.remove('is-success', 'is-danger');
                    emailPhoneInput.classList.add('is-info');

                } else if (isValidEmail(emailPhoneInput.value) || isValidPhone(emailPhoneInput.value)) {
                    emailPhoneInput.classList.remove('is-info', 'is-danger');
                    emailPhoneInput.classList.add('is-success');
                } else {
                    emailPhoneInput.classList.remove('is-info', 'is-success');
                    emailPhoneInput.classList.add('is-danger');

                }
            });

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isValidPhone(phone) {
                const phoneRegex = /^\d{9,10}$/;
                return phoneRegex.test(phone);
            }
        });
    </script>
@endsection --}}
