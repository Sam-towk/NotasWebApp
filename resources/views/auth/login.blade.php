<x-guest-layout>
    <div class="w-full w-96 max-w-sm bg-slate-900 border border-slate-800 p-8 rounded-3xl shadow-2xl text-center flex flex-col items-center justify-center">
        
        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-indigo-500/50 shadow-lg shadow-indigo-500/20 mb-4 bg-slate-800 flex items-center justify-center">
            <img id="foto-perfil" src="{{ asset('storage/perfis/avatar_default.jpg') }}" alt="Foto de Perfil" class="w-full h-full max-w-full max-h-full object-cover block">
        </div>

        <h2 class="text-2xl font-bold text-white mb-1">Bem vindo</h2>
        <p id="nome-usuario" class="text-sm font-medium text-slate-400 mb-6">...</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-400 bg-red-500/10 p-2 rounded-xl w-full text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
            @csrf

            <div class="w-full">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                    placeholder="Digite seu e-mail..." 
                    onblur="atualizarPerfil(this.value)"
                    class="w-full px-5 py-3 rounded-full bg-white text-gray-900 !border-none focus:!border-none !ring-0 focus:!ring-0 outline-none focus:outline-none text-center placeholder-gray-400 shadow-inner block">
            </div>

            <div class="w-full">
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    placeholder="Digite sua senha..." 
                    class="w-full px-5 py-3 rounded-full bg-white text-gray-900 !border-none focus:!border-none !ring-0 focus:!ring-0 outline-none focus:outline-none text-center placeholder-gray-400 shadow-inner block">
            </div>

           <div class="w-full pt-2 !border-none !outline-none">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-150 ease-in-out uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg !border-none !outline-none focus:!outline-none !ring-0 focus:!ring-0">
                    Login 
                </button>
            </div>
        </form>
    </div>

    <script>
        function atualizarPerfil(email) {
            if (!email || !email.includes('@')) {
                document.getElementById('nome-usuario').textContent = '...';
                document.getElementById('foto-perfil').src = "{{ asset('storage/perfis/avatar_default.jpg') }}";
                return;
            }
            
            const campoNome = document.getElementById('nome-usuario');
            const imagemPerfil = document.getElementById('foto-perfil');

            let nomeExtraido = email.split('@')[0];
            nomeExtraido = nomeExtraido.replace(/[._]/g, ' ');
            nomeExtraido = nomeExtraido.split(' ').map(p => p.charAt(0).toUpperCase() + p.slice(1)).join(' ');
            campoNome.textContent = nomeExtraido;

            const nomeArquivo = email.replace(/[^a-zA-Z0-9]/g, "_").toLowerCase();
            const caminhoFoto = `/storage/perfis/${nomeArquivo}.png`;
            
            const imgTeste = new Image();
            imgTeste.src = caminhoFoto;
            
            imgTeste.onload = function() {
                imagemPerfil.src = caminhoFoto;
            };
            
            imgTeste.onerror = function() {
                imagemPerfil.src = "{{ asset('storage/perfis/avatar_default.jpg') }}";
            };
        }

        window.addEventListener('DOMContentLoaded', () => {
            const emailInput = document.getElementById('email');
            if(emailInput && emailInput.value) {
                atualizarPerfil(emailInput.value);
            }
        });
    </script>
</x-guest-layout>