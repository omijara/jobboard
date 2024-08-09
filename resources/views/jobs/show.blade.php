<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

<h2 class="font-bold text-lg">{{$job->title}}</h2>

<p>This job pays {{$job->salary}} BDT Per Month</p>
<p class="mt-6">
    @can('edit', $job)
    <x-button href="/jobs/{{$job->id}}/edit">Edit</x-button>
    <button form="delete_form" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 border border-red-700 leading-5 rounded-md hover:bg-red-600 focus:outline-none focus:ring ring-red-300 focus:border-red-300 active:bg-red-800 active:text-white transition ease-in-out duration-150 dark:bg-red-800 dark:border-red-700 dark:focus:border-red-700 dark:active:bg-red-900 dark:active:text-white">
        Delete
    </button>
    @endcan      
</p>

<form method="POST" action="/jobs/{{ $job->id }}" class="hidden" id="delete_form">
    @csrf
    @method('DELETE')
</form>

</x-layout>