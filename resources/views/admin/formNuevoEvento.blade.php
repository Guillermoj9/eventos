<x-app-layout>
    <x-slot name="header">
            <a href="/eventos/nuevo"><button type='button' class="bg-blue-400 hover:bg-blue-600 text-white py-2 px-4 rounded">Crear evento</button></a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

    <div class="w-full max-w-xs mx-auto">
        <h3 class='text-lg text-orange-500'>Nuevo Evento</h3>
        
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method='POST' action='/eventos/guardar' enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nombre
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" name="name" type="text" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Date
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="date" name="date" type="date" placeholder="10" value="{{ old('date') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Descripción
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="description" name="description" value="{{ old('description') }}"  type="text">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="city">
                    Localidad
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="city" name="city" value="{{ old('city') }}"  type="text">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Address
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="address" name="address" value="{{ old('address') }}"  type="text">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="aforomax">
                    AforoMax
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="aforomax" name="aforomax" value="{{ old('aforomax') }}"  type="number">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                    Tipo
                </label>
                <select
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    name="tipo">
                    <option value="online">online</option>
                    <option value="presencial">presencial</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="numMaxEntradas">
                    numMaxEntradas
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="numMaxEntradas" name="numMaxEntradas" value="{{ old('numMaxEntradas') }}"  type="number">
            </div>

            <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoria_id">
                    categoria
                    </label>
                   <select
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    name="categoria_id">
                    @foreach($categorias as $categoria)
                       <option value= {{$categoria->id}}>  {{$categoria->name}}</option> 
                   @endforeach
                </select>
            </div>

            <input type="hidden" name="user_id"  value="{{Auth::user()->id}}">
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-orange-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Crear
                </button>
            </div>
        </form>
    </div>


            </div>
        </div>
    </div>
</x-app-layout>