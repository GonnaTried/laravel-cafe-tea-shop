@extends('admin.layout.index')

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">User Management</h1>

        {{-- Success/Error Message Display --}}
        @if (session('success'))
            <div class="notification is-success is-light">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="notification is-danger is-light">
                {{ session('error') }}
            </div>
        @endif
        <br>
        {{-- Add New User Button and User Count --}}
        <div class="columns is-mobile is-justify-content-space-between is-align-items-center mb-4">
            <div class="column is-narrow">
                {{-- CHANGE COUNT DISPLAY --}}
                <p class="is-size-6 has-text-grey">Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of
                    {{ $users->total() }} users</p>
            </div>
            <div class="column is-narrow">
                {{-- CHANGE BUTTON ROUTE AND TEXT --}}
                <a href="{{ route('admin.users.create') }}" class="button is-primary is-normal">
                    <span class="icon is-small">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span>Add New User</span>
                </a>
            </div>
        </div>

        {{-- Users List (Card-like structure) --}}
        <div class="box">
            {{-- CHANGE LOOP VARIABLE --}}
            @forelse ($users as $user)
                <article class="media is-align-items-center py-4 {{ !$loop->last ? 'border-bottom' : '' }}">

                    <div class="media-content">
                        <div class="content">
                            <p>
                                {{-- DISPLAY USER INFORMATION --}}
                                <strong>User ID: {{ $user->id }}</strong>
                                <br>
                                Phone: {{ $user->phone }}
                                <br>
                                {{-- You can add other user details here like registration date if you add a name/email later --}}
                                Joined: {{ $user->created_at->format('Y-m-d H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <div class="buttons are-small">
                            {{-- CHANGE BUTTON ROUTES --}}
                            <a href="{{ route('admin.users.show', $user) }}" class="button is-info is-light"
                                title="View Details">
                                <span class="icon"><i class="fas fa-eye"></i></span>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="button is-warning is-light"
                                title="Edit">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                            </a>
                            {{-- CHANGE FORM ROUTE AND CONFIRM MESSAGE --}}
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user (Phone: {{ $user->phone }})?');"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-danger is-light" title="Delete">
                                    <span class="icon"><i class="fas fa-trash"></i></span>
                                </button>
                            </form>
                        </div>

                    </div>
                </article>
            @empty
                {{-- CHANGE EMPTY MESSAGE --}}
                <div class="content has-text-centered">
                    <p>No users found.</p>
                </div>
            @endforelse
        </div>
        {{-- Pagination Links --}}
        <div class="mt-4">
            {{-- Pagination variable name matches the loop variable --}}
            {{ $users->links('pagination::default') }}
        </div>

    </div>
    <br>

    {{-- Basic custom CSS for the border --}}
    <style>
        .border-bottom {
            border-bottom: 1px solid #dbdbdb;
        }
    </style>
@endsection
