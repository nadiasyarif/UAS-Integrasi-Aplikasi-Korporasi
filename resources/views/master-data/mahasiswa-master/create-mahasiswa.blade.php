<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    <div class="py-12">
       
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto mt-5">
                        <h2 class="mb-5 text-2xl font-bold">Tambah Data Mahasiswa</h2>
                        <x-auth-session-status class="mb-4" :status="session('success')" />
                        @if ($errors->any())
                            <div class="mb-5 text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                            <form action="{{ route('mahasiswa-store')}}" method="POST" class="space-y-4">
                            @csrf <!-- Laravel CSRF protection -->
                           
                            <div class="form-group">
                                <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
                                <input type="text" id="npm" name="npm" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="form-group">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                                <input type="text" id="nama" name="nama" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>
               
                            <div class="form-group">
                                <label for="prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                                <select id="prodi" name="prodi" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    <option value="Sistem Informasi">Sistem Informasi (SI)</option>
                                    <option value="Informatika">Informatika (IF)</option>
                                </select>
                            </div>

                            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                        </form>
                    </div>
               
                    @vite('resources/js/app.js') <!-- Include Vite's JS assets -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>