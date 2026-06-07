<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 flex justify-between items-center bg-gray-50 p-3 rounded border border-gray-100">
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                            &larr; Voltar para o Painel
                        </a>
                    </div>

                    <div>
                        <form action="{{ route('notas.destroy', $slug) }}" method="POST" onsubmit="return confirm('Tem certeza?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow transition">
                                🗑️ Apagar Nota
                            </button>
                        </form>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-800 bg-gray-50 p-4 rounded border border-gray-200 whitespace-pre-wrap font-mono">
                    {{ $conteudo }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>