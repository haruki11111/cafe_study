@props(['messages'])
@if(!empty($messages))
    <ul class="text-red-600 text-sm space-y-1">
        @foreach($messages as $msg)
            <li>{{ $msg }}</li>
        @endforeach
    </ul>
@endif