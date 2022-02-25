<div class="p-12">
    <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr class="text-center ">

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
                                    @if (isset($cetak_pegawai) && count((array)$cetak_pegawai))
                                        @foreach ($cetak_pegawai as $pegawai)
                                        <tr class="text-center">

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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
</div>
