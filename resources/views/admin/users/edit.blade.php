@extends('admin.layout.index')

{{-- Change Title --}}
@section('title', 'Edit User: ' . $user->phone)

@section('content')
    <div class="container is-fluid">

        {{-- Change Title --}}
        <h1 class="title is-4">Edit User: {{ $user->phone }}</h1>

        <div class="box">

            {{-- Change Form Action and Method --}}
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Phone Number --}}
                <div class="field">
                    <label class="label" for="phone">Phone <span class="has-text-danger">*</span></label>
                    <div class="control">
                        {{-- Input field for phone --}}
                        <input class="input @error('phone') is-danger @enderror" type="text" name="phone"
                            id="phone" value="{{ old('phone', $user->phone) }}" required autofocus>
                    </div>
                    @error('phone')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password (Optional Update) --}}
                <div class="field">
                    <label class="label" for="password">New Password (Optional)</label>
                    <div class="control">
                        {{-- Input field for password - not required for edit --}}
                        <input class="input @error('password') is-danger @enderror" type="password" name="password"
                            id="password">
                    </div>
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    <p class="help">Leave blank to keep the current password.</p>
                </div>

                {{-- Removed Category, Description, Ingredients, Price, Inventory, Image Upload --}}
                {{-- You can add fields here if you add more columns to your 'users' table (e.g., name, email, role) --}}

                {{-- Submit and Cancel Buttons --}}
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">Save Changes</button>
                    </div>
                    <div class="control">
                        {{-- Change Cancel Button Route --}}
                        <a href="{{ route('admin.users.index') }}" class="button is-link is-light">Cancel</a>
                    </div>
                </div>

            </form>
        </div>

    </div>


@endsection
