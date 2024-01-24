<!-- resources/views/meetings/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="">
                        <h2>Meeting List</h2>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('meetings.create') }}" class="btn btn-primary">Create Meeting</a>
                        </div>

                        <table class="table mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Date/Time</th>
                                    <th>Creator</th>
                                    <th>Attendees</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->id }}</td>
                                        <td>{{ $meeting->subject }}</td>
                                        <td>{{ $meeting->date_time }}</td>
                                        <td>{{ $meeting->creator->name }}</td>
                                        <td>
                                            @foreach($meeting->attendees as $attendee)
                                                {{ $attendee->name }},
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No meetings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $meetings->links() }}
                    </div>
        </div>
        </div>
    </div>
</div>
</x-app-layout>
