<x-layout>
    <x-slot:heading>
        Jobs page
    </x-slot:heading>
     @foreach ($jobs as $job)
        {{-- show job title and salary --}}
        <li><a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
            <strong>{{ $job['title'] }}</strong>
            <span>{{ $job['salary'] }}</span>
        </a></li>
    @endforeach
</x-layout>