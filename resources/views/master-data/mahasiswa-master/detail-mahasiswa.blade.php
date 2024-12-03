<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{('Mahasiswa Detail')}}
        </h2>
    </x-slot>
    
    <div class="container mx-auto p-4">
        <div class="overflow-x-auto rounded-lgbg-white p-6 shadow-md" style="background-color: white">
            <!-- Back button -->
            <a href="{{ route('mahasiswa-index') }}" class="text-blue-500 hover:underline">+ Back</a>
            <div class="mt-4">
                <h3 class="mb-4 text-2xl font-semibold">{{ $mahasiswas->npm}}</h3>
                <p><strong>ID:</strong> {{ $mahasiswas->id }}</p>
                <p><strong>Nama:</strong> {{ $mahasiswas->nama }}</p>
                <p><strong>Program Studi:</strong> {{ $mahasiswas->prodi }}</p>
            </div>
        </div>
    </div>    
</x-app-Layout>