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
                        <h2>Edit Meeting</h2>
                
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                
                        <form action="{{ route('meetings.update', $meeting->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" value="{{ $meeting->subject }}">
                            </div>
                
                            <div class="form-group">
                                <label for="date_time">Date/Time:</label>
                                <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ optional($meeting->date_time)->format('Y-m-d\TH:i') }}">
                            </div>
                
                            <!-- Add other form fields as needed -->
                
                            <button type="submit" class="btn btn-primary">Update Meeting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>