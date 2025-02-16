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
                                <label class="title is-4 has-text-white">Phone Number or Email</label>
                                <input class="input" type="text" id="email_phone" placeholder="myemail@email.com" />
                                <br>
                                <br>
                                <label class="title is-4 has-text-white">Password</label>
                                <input class="input" type="password" id="password" placeholder="#1245ksde$$" />
                                <br>
                                <br>
                                <div class="field is-centered">
                                    <div class="column has-text-centered">
                                        <button class="button is-primary" type="submit">Login</button>
                                    </div>
                                    <div class="column has-text-centered">
                                        <h3>Don't have account yet?</h3>
                                        <button class="button is-primary">Register Here</button>
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

@section('scripts')
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
                const phoneRegex = /^\d{10}$/; // Example: 10-digit phone number
                return phoneRegex.test(phone);
            }
        });
    </script>
@endsection
