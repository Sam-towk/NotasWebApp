<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel de Notas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        <div class="border-r border-gray-200 pr-4 w-full min-w-0">
                            <h3 class="text-lg font-bold mb-4 text-gray-700">Minhas Notas</h3>
                            
                            @if(empty($notas))
                                <p class="text-sm text-gray-500 italic">Nenhuma nota criada ainda.</p>
                            @else
                                <ul class="space-y-2 w-full truncate">
                                    @foreach($notas as $nota)
                                        <li class="w-full min-w-0">
                                            <a href="{{ route('notas.show', $nota['slug']) }}" class="block p-2 rounded-md hover:bg-gray-100 text-indigo-600 font-medium transition break-all whitespace-normal">
                                                📄 {{ $nota['titulo'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="md:col-span-3 pl-2">
                            <h3 class="text-lg font-bold mb-4 text-gray-700">Criar Nova Nota (.md)</h3>

                            @if (session('status'))
                                <div class="mb-4 text-sm font-medium text-green-600 p-2 bg-green-100 rounded">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('notas.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título da Nota</label>
                                    <input type="text" name="titulo" id="titulo" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label for="conteudo" class="block text-sm font-medium text-gray-700"></label>
                                    <textarea name="conteudo" id="conteudo" rows="6" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="O que estou pensando hoje..."></textarea>
                                </div>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition">
                                    Salvar Nota
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>