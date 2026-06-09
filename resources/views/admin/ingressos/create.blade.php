@extends('template')

@section('titulo', 'Novo Ingresso - Admin')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem; max-width: 600px;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">🎫 Novo Ingresso</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">Cadastre um novo ingresso para venda.</p>
    </div>

    <form action="{{ route('admin.ingressos.store') }}" method="POST" style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem;">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="jogo" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">
                Jogo
            </label>
            <input type="text"
                   id="jogo"
                   name="jogo"
                   value="{{ old('jogo') }}"
                   required
                   placeholder="Ex: Brasil vs Argentina - Quartas de Final"
                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='#059669'"
                   onblur="this.style.borderColor='#d1d5db'">
            @error('jogo')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="setor" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">
                Setor
            </label>
            <input type="text"
                   id="setor"
                   name="setor"
                   value="{{ old('setor') }}"
                   required
                   placeholder="Ex: Arquibancada Norte, Camarotes..."
                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='#059669'"
                   onblur="this.style.borderColor='#d1d5db'">
            @error('setor')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="preco" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">
                Preço (R$)
            </label>
            <input type="number"
                   id="preco"
                   name="preco"
                   value="{{ old('preco') }}"
                   required
                   step="0.01"
                   min="0"
                   placeholder="0,00"
                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='#059669'"
                   onblur="this.style.borderColor='#d1d5db'">
            @error('preco')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="quantidade" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">
                Quantidade Disponível
            </label>
            <input type="number"
                   id="quantidade"
                   name="quantidade"
                   value="{{ old('quantidade') }}"
                   required
                   min="0"
                   placeholder="0"
                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='#059669'"
                   onblur="this.style.borderColor='#d1d5db'">
            @error('quantidade')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('admin.ingressos.index') }}"
               style="flex: 1; padding: 0.875rem 1.5rem; border: 2px solid #e5e7eb; background: white; color: #374151; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600;">
                Cancelar
            </a>
            <button type="submit"
                    style="flex: 1; padding: 0.875rem 1.5rem; background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; border: none; border-radius: 0.5rem; font-weight: 600; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3); cursor: pointer;">
                Cadastrar Ingresso
            </button>
        </div>
    </form>
</div>
@endsection