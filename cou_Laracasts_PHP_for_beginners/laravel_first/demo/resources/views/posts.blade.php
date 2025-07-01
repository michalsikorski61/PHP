<x-layout>
    <x-slot:heading>
        Posts Listing
    </x-slot:heading>
    <ul>
        @foreach ($posts as $post)
            <a href="/post/{{ $post['id'] }}" class="text-blue-500 hover:underline">
            <li><strong>{{ $post['title'] }}</strong>.
            </a>
        @endforeach
    </ul>
</x-layout>