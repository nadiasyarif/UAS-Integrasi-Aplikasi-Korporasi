<x-app-layout>
    <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
      </h2>
    </x-slot>
   
    <div class="container p-4 mx-auto">
      <div class="overflow-x-auto">
        @if (@session('success'))
          <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
            {{ session('success') }}
          </div>
        @elseif (@session('error'))
          <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
            {{ session('error') }}
          </div>
        @endif

        <form method="GET" action="{{ route('mahasiswa-index') }}" class="mb-4 flex items-center">
          <input type="text" name="search" value="{{ request("search") }}" placeholder="Cari mahasiswa.." class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
          <button type="submit" class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2
          focus:ring-green-500">Cari</button>
        </form>
        
        <a href="{{ route('mahasiswa-create')}}">
            <button class="px-6 py-4 mb-5 text-white bg-green-500 border border-green-400 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                Tambah Data Mahasiswa
            </button>
        </a>
        <a href="{{ route('mahasiswa-export-excel')}}">
          <button class="px-6 py-4 mb-5 text-green bg-white-500 border border-green-400 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
              Export (.xls)
          </button>
        </a>
        <a href="{{ route('mahasiswa-export-pdf')}}">
          <button class="px-6 py-4 mb-5 text-green bg-white-500 border border-green-400 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
              Export (.pdf)
          </button>
        </a>

          <table class="min-w-full border border-collapse border-gray-200">
            <thead>
              <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">NPM</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Program Studi</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($mahasiswas as $mahasiswa)
                <tr class="bg-white">
                  <td class="border border-gray-200 px-4 py-2">{{ $mahasiswa->id }}</td>
                  <td class="border border-gray-200 px-4 py-2 hover: text-blue-500 hover:underline">
                    <a href="{{ route('mahasiswa-detail', $mahasiswa->id) }}">
                      {{ $mahasiswa->npm}}
                    </a>
                  </td>
                  <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->nama }}</td>
                  <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->prodi }}</td>
                  <td class="px-4 py-2 border border-gray-200">
                    <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('mahasiswa-deleted', $mahasiswa->id) }}')">Hapus</button>
                  </td>
                </tr>
              @empty
              <p class="mb-4 text-center text-2xl font-bold text-red-600">No mahasiswas Found</p>
              @endforelse
              <!-- Tambahkan baris lainnya sesuai kebutuhan -->
            </tbody>
          </table>
          <div class="mt-4">
            {{ $mahasiswas->appends(['search'=>request('search')])->links() }}
          </div>
        </div>
      </div>
    
    
      <script>
        function confirmDelete(deleteUrl) {
                console.log(deleteUrl);
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
       
                    // Tambahkan CSRF token
                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);
       
                    // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
                    let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
   
                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        }
  </script>




</x-app-layout>
