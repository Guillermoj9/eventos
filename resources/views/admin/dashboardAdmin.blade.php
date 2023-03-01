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
                    {{ __("Te has logeado como admin!") }}
                </div>
                <a href="/eventos/nuevo"><button>Crear evento</button></a>

                <!-- BUSCAR POR FECHA  -->
                <form class="form-inline" action="/eventos/buscarFecha" method="post">
                @csrf    
                <input name="date" class="form-control mr-sm-2" type="date" placeholder="Buscar por " aria-label="Search">

                    <button class="" type="submit">Buscar</button>
                </form>
                <!-- BUSCAR POR CIUDAD  -->
                <form class="form-inline" action="/eventos/buscarCiudad" method="post">
                @csrf    
                <input name="city" class="form-control mr-sm-2" type="text" placeholder="Buscar por ciudad " aria-label="Search">

                    <button class="" type="submit">Buscar</button>
                </form>
                <!-- BUSCAR POR CATEGORIA  -->
                <form class="form-inline" action="/eventos/buscarCategoria" method="post">
                @csrf    
                <input name="buscarCategoria" class="form-control mr-sm-2" type="text" placeholder="Buscar por categoria " aria-label="Search">

                    <button class="" type="submit">Buscar</button>
                </form>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    city
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    aforomax
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    tipo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    numMaxEntradas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventos as $evento)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{$evento -> name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{$evento -> date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> city }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> aforomax }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> tipo }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$evento -> numMaxEntradas }}
                                </td>
                                
                                <td class="px-6 py-4">
                                @foreach ( $categorias as $categoria)
                                @if($evento->categoria_id==$categoria->id) 
                                 {{$categoria->name}}
                                @endif  
                                @endforeach
                                </td>
                            
                                <td class="px-6 py-4 text-right">
                                    <a href="/eventos/{{$evento->id}}/show" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">INFO</a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="/eventos/{{ $evento->id }}/destroy" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">BORRAR</a>
                                </td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</x-app-layout>