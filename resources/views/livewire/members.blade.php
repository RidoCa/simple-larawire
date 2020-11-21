<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Anggota</h2>
</x-slot>

<div class="py-12">
    <div class="mx-w-7xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white overlow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{session('message')}}</p>
                    </div>
                </div>
            </div>
            @endif
            
            {{-- button create data dengan event wire:click --}}
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Data Anggota</button>

            {{-- kondisi untuk menampilkan modal --}}
            @if ($isModal)
                @include('livewire.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Telp</th>
                        <th class="px-4 py-2 w-24">Status</th>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $row)
                    <tr>
                        <td class="border px-4 py-2">{{$row->name}}</td>
                        <td class="border px-4 py-2">{{$row->email}}</td>
                        <td class="border px-4 py-2">{{$row->phone_number}}</td>
                        <td class="border px-4 py-2">{!! $row->status_label !!}</td>
                        <td class="border px-4 py-2" align="center"> <img src="{{Storage::url($row->foto)}}" alt="" class="w-10 h-13"> </td>
                        <td class="border px-4 py-2" style="text-align: center">
                        {{-- edit data dengen event edit dan memparsing data id --}}
                        <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                        {{-- delete data event delete dan memparsing data id --}}
                        <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="5">Tidak Ada Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>