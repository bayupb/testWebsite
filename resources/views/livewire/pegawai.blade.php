<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">
    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">
            <button wire:click="openModalData()"
                class="bg-blue-100 px-2 py-2 text-sm text-black font-medium hover:bg-blue-300 rounded">Tambah
                Pegawai</button>
            <button wire:click="cetakpegawai()"
                class="bg-yellow-500 px-2 py-2 text-sm text-black font-medium hover:bg-blue-300 rounded">Cetak Pegawai
                Pegawai</button>
            @if ($openModal)
            @include('livewire.modal.pegawai-modal')
            @endif
            <div class="bg-white shadow-md px-2 py-2 my-2">
                <div class="flex gap-4 px-5 items-center justify-center py-5">
                    <input type="text" wire:model="search" placeholder="Cari Data" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                    <select wire:model="filterjeniskelamin" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                        <option value="0">Laki</option>
                        <option value="1">Perempuan</option>
                    </select>
                    <select wire:model="Filterpenempatan" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                        <option value="">Filter Tempat tugas</option>
                        @foreach ($Penempatan as $penempatan)
                            <option value="{{$penempatan->id}}">{{$penempatan->nama_penempatan}}</option>
                        @endforeach
                    </select>
                    <select wire:model="filteragama" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                        <option value="">Filter Agama</option>
                        @foreach ($Agama as $agama)
                            <option value="{{$agama->id}}">{{$agama->nama_agama}}</option>
                        @endforeach
                    </select>

                    {{-- {{$Filterjabatan}} --}}
                    <select wire:model="Filterjabatan" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                        <option value="">Filter Jabatan</option>
                        @foreach ($Jabatan as $jabatan)
                            <option value="{{$jabatan->id}}">{{$jabatan->nama_jabatan}}</option>
                        @endforeach
                    </select>
                    <select wire:model="filtergolongan" class="rounded-md border border-gray-50 appearance-none ring ring-indigo-200">
                        <option>Filter Golongan</option>
                        @foreach ($Golongan as $golongan)
                            <option value="{{$golongan->id}}">{{$golongan->nama_golongan}}</option>
                        @endforeach
                    </select>
                </div>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr class="text-center ">
                                        <th
                                            class=" px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                            Gambar</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Nip</th>

                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Nama</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Tempat Lahir</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Alamat</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            L/P</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Gol</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Eleson</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Jabatan</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Tempat Tugas</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Agama</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Unit kerja</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            No Hp</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Npwp</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($Pegawai->count()>0)
                                    @foreach ($Pegawai as $pegawai)
                                    <tr class="text-center">
                                        <td class="px-2 py-2">
                                            @if ($pegawai->gambar_pegawai)
                                            <img src="{{ asset('storage/'.$pegawai->gambar_pegawai) }}"
                                                class="w-12 h-12 rounded justify-center">
                                            @else
                                            <span>Tidak ada Gambar</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->nip_pegawai }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->nama_pegawai }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->tempat_lahir_pegawai }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->alamat_pegawai }}</td>
                                        <td class="px-2 py-3 text-sm">
                                            @if ($pegawai->jenis_kelamin_pegawai == 0)
                                            Laki
                                            @else
                                            Perempuan
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->golongan->nama_golongan }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->eselon }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->jabatan->nama_jabatan }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->penempatan->nama_penempatan }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->agama->nama_agama }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->unit_kerja }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->no_hp }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $pegawai->npwp }}</td>

                                        <td class="px-2 py-3 flex text-sm text-gray-900">
                                            <button wire:click="edit({{ $pegawai->id }})"
                                                class="bg-green-100 mx-2 px-2 py-1">Edit</button>
                                            <button wire:click="delete({{ $pegawai->id }})"
                                                class="bg-red-100 px-2 py-1">Hapus</button>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="flex justify-center text-center">
                                        <td class="text-base">Tidaak ada data</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $Pegawai->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


