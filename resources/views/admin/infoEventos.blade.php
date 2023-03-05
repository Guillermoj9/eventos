<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Info del evento") }}
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    DNI
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SUBNAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CITY
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PHONE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($asistentes as $asistente)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{$asistente -> dni }}
                                </th>
                                <td class="px-6 py-4">
                                    {{$asistente -> name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$asistente -> subname }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$asistente -> city }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$asistente -> phone }}
                                </td>
                               @if(Auth::User()->role == "admin" || Auth::User()->id_user == $evento->user_id)
                                <td class="px-6 py-4 text-right">
                                    <a href="/eventos/{{ $evento->id }}/eliminar/{{ $asistente->id }}/usuario" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">BORRAR</a>
                                </td>
                                @endif
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

</x-app-layout>