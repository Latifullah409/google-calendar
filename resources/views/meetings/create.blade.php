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
                        <h2>Create Meeting</h2>
                
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <form action="{{ route('meetings.store') }}" method="POST">
                            @csrf
                
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}">
                            </div>
                
                            <div class="form-group">
                                <label for="date_time">Date/Time:</label>
                                <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ old('date_time') }}">
                            </div>
                
                            <div class="form-group">
                                <label for="attendees">Attendees (select 2):</label>
                                <select name="attendees[]" id="attendees" class="form-control js-example-basic-multiple-limit" multiple="multiple">
                                    <!-- Loop through users to populate the dropdown -->
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <button type="submit" class="btn btn-primary">Create Meeting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function() {
            // $(".js-example-basic-multiple-limit").select2({
            //    maximumSelectionLength: 2
            // });
            $("select").select2({
			closeOnSelect : false,
			placeholder : "Placeholder",
			allowHtml: true,
			allowClear: true,
			tags: true // создает новые опции на лету
		});
        });

    </script>
</x-app-layout>