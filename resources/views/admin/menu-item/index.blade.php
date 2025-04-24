@extends('layouts.admin')

@section('title', 'Manage Menu Items')

@section('content')
    <h1 class="title">Manage Menu Items</h1>

    <a href="{{ route('admin.menu-items.create') }}" class="button is-primary mb-4">Add New Menu Item</a>

    @if ($menuItems->count() > 0)
        <table class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuItems as $menuItem)
                    <tr>
                        <td>{{ $menuItem->id }}</td>
                        <td>{{ $menuItem->name }}</td>
                        <td>{{ $menuItem->price }}$</td>
                        <td>{{ $menuItem->category->name ?? 'N/A' }}</td> {{-- Assuming a category relationship --}}
                        <td>
                            <a href="{{ route('admin.menu-items.edit', $menuItem) }}" class="button is-small is-info">Edit</a>
                            <form action="{{ route('admin.menu-items.destroy', $menuItem) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-small is-danger"
                                    onclick="return confirm('Are you sure you want to delete this menu item?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No menu items found.</p>
    @endif

@endsection
