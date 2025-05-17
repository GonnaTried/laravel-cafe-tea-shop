@extends('frontend.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Register</h1>
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <div class="notification is-dark">
                            <label class="title is-4 has-text-white">Phone Number</label>
                            <input class="input @error('phone') is-danger @enderror" type="text" id="phone"
                                name="phone" placeholder="012xxxxxxx" value="{{ old('phone') }}" />
                            @error('phone')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <br>
                            <br>

                            <label class="title is-4 has-text-white">Password</label>
                            <input class="input @error('password') is-danger @enderror" type="password" id="password"
                                name="password" placeholder="#1245ksde$$" />
                            @error('password')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <br>
                            <br>


                            <label class="title is-4 has-text-white">Confirm Password</label>
                            <input class="input @error('confirmPassword') is-danger @enderror" type="password"
                                id="confirmPassword" name="confirmPassword" placeholder="#1245ksde$$" />
                            @error('confirmPassword')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <br>
                            <br>


                            <label class="checkbox has-text-white">
                                <input type="checkbox" id="terms" name="terms">
                                I agree to the <a href="/terms-and-conditions">Terms and Conditions</a>
                            </label>
                            @error('terms')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <div class="field is-centered">
                                <div class="column has-text-centered">
                                    <button class="button is-primary" type="submit">Register</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                    <div class="column has-text-centered">
                                    <h3>Already Have Account?</h3>
                                    <button class="button is-primary">Login Here</button>
                                </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const termsCheckbox = document.getElementById('terms');

            const phoneError = document.getElementById('phoneError');
            const passwordError = document.getElementById('passwordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const termsError = document.getElementById('termsError');


            phoneInput.addEventListener('blur', function() {
                validatePhone();
            });

            passwordInput.addEventListener('blur', function() {
                validatePassword();
                validateConfirmPassword(); // Also validate confirm password in case password changes.
            });

            confirmPasswordInput.addEventListener('blur', function() {
                validateConfirmPassword();
            });

            registerForm.addEventListener('submit', function(event) {
                let isValid = true;

                if (!validatePhone()) {
                    isValid = false;
                }

                if (!validatePassword()) {
                    isValid = false;
                }

                if (!validateConfirmPassword()) {
                    isValid = false;
                }

                if (!termsCheckbox.checked) {
                    termsError.textContent = 'You must agree to the Terms and Conditions.';
                    isValid = false;
                } else {
                    termsError.textContent = '';
                }


                if (!isValid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            function validatePhone() {
                if (phoneInput.value === '') {
                    phoneInput.classList.remove('is-success', 'is-danger');
                    phoneInput.classList.add('is-info');
                    phoneError.textContent = '';
                    return false; // Allow empty for now, change if required
                } else if (isValidPhone(phoneInput.value)) {
                    phoneInput.classList.remove('is-danger', 'is-info');
                    phoneInput.classList.add('is-success');
                    phoneError.textContent = '';
                    return true;
                } else {
                    phoneInput.classList.remove('is-success', 'is-info');
                    phoneInput.classList.add('is-danger');
                    phoneError.textContent = 'Please enter a valid phone number (9-10 digits).';
                    return false;
                }
            }

            function validatePassword() {
                if (passwordInput.value === '') {
                    passwordInput.classList.remove('is-success', 'is-danger');
                    passwordInput.classList.add('is-info');
                    passwordError.textContent = '';
                    return false; 
                } else if (passwordInput.value.length >= 8) {
                    passwordInput.classList.remove('is-danger', 'is-info');
                    passwordInput.classList.add('is-success');
                    passwordError.textContent = '';
                    return true;
                } else {
                    passwordInput.classList.remove('is-success', 'is-info');
                    passwordInput.classList.add('is-danger');
                    passwordError.textContent = 'Password must be at least 8 characters long.';
                    return false;
                }
            }

            function validateConfirmPassword() {
                if (confirmPasswordInput.value === '') {
                    confirmPasswordInput.classList.remove('is-success', 'is-danger');
                    confirmPasswordInput.classList.add('is-info');
                    confirmPasswordError.textContent = '';
                    return false; // Allow empty for now, change if required
                } else if (confirmPasswordInput.value === passwordInput.value) {
                    confirmPasswordInput.classList.remove('is-danger', 'is-info');
                    confirmPasswordInput.classList.add('is-success');
                    confirmPasswordError.textContent = '';
                    return true;
                } else {
                    confirmPasswordInput.classList.remove('is-success', 'is-info');
                    confirmPasswordInput.classList.add('is-danger');
                    confirmPasswordError.textContent = 'Passwords do not match.';
                    return false;
                }
            }


            function isValidPhone(phone) {
                const phoneRegex = /^\d{9,10}$/;
                return phoneRegex.test(phone);
            }
        });
    </script>
@endsection --}}
