<div class="flex h-auto w-full flex-1 flex-col gap-2 rounded-xl">

    <div class="flex justify-between">
        <div>
            <flux:heading size="xl">Internships List</flux:heading>
            <flux:text size="lg">List laporan PKL yang siswa ajukan.</flux:text>
        </div>
        
        <flux:modal.trigger name="add-intern">
            <flux:button class="self-end" wire:click="resetInputFields()">Tambah</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="add-intern" class="w-144">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Pengajuan PKL</flux:heading>
                <flux:text class="mt-2">Tambah laporan pengajuan PKL.</flux:text>
            </div>
            <flux:select label="Siswa" placeholder="Select Siswa" wire:model="siswa_id" required>
                @foreach ($daftarSiswa as $siswa)
                <flux:select.option value="{{ $siswa->id }}">{{ $siswa->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select label="Guru" placeholder="Select Guru" wire:model="guru_id" required>
                @foreach ($daftarGuru as $guru)
                <flux:select.option value="{{ $guru->id }}">{{ $guru->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select label="Industri" placeholder="Select Industry" wire:model="industri_id" required>
                @foreach ($daftarIndustri as $industri)
                <flux:select.option value="{{ $industri->id }}">{{ $industri->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <div class="grid grid-cols-2 gap-3">
                <flux:input type="date" label="Mulai" wire:model="mulai" />
                <flux:input type="date" label="Selesai" wire:model="selesai" />
            </div>
            <flux:button variant="primary" class="w-full" wire:click.prevent="store()">Tambah</flux:button>
        </div>
    </flux:modal>

    <flux:modal name="edit-intern" class="w-144">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Pengajuan PKL</flux:heading>
                <flux:text class="mt-2">Edit laporan pengajuan PKL.</flux:text>
            </div>
            <flux:input type="hidden" wire:model="intern_id" />
            <flux:select label="Siswa" placeholder="Select Siswa" wire:model="siswa_id" required>
                @foreach ($daftarSiswa as $siswa)
                <flux:select.option value="{{ $siswa->id }}">{{ $siswa->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select label="Guru" placeholder="Select Guru" wire:model="guru_id" required>
                @foreach ($daftarGuru as $guru)
                <flux:select.option value="{{ $guru->id }}">{{ $guru->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select label="Industri" placeholder="Select Industry" wire:model="industri_id" required>
                @foreach ($daftarIndustri as $industri)
                <flux:select.option value="{{ $industri->id }}">{{ $industri->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <div class="grid grid-cols-2 gap-3">
                <flux:input type="date" label="Mulai" wire:model="mulai" />
                <flux:input type="date" label="Selesai" wire:model="selesai" />
            </div>
            <flux:button variant="primary" class="w-full" wire:click.prevent="update()">Simpan</flux:button>
        </div>
    </flux:modal>

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full dark:text-gray-100">
            <thead class="text-gray-100 uppercase">
                <tr class="dark:bg-[#181818]">
                    <th class="px-2 py-2">Siswa</th>
                    <th class="px-2 py-2">Guru</th>
                    <th class="px-2 py-2">Industri</th>
                    <th class="px-2 py-2">Mulai</th>
                    <th class="px-2 py-2">Selesai</th>
                    <th class="px-2 py-2">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($internships as $intern)
                <tr class="border-t dark:border-[#555555] text-sm">
                    <td class="py-3 px-6">{{ $intern->siswa->nama ?? '-' }}</td>
                    <td class="py-3 px-6">{{ $intern->guru->nama ?? '-' }}</td>
                    <td class="py-3 px-6">{{ $intern->industri->nama ?? '-' }}</td>
                    <td class="py-3 px-3 text-center">{{ \Carbon\Carbon::parse($intern->mulai)->locale('id')->translatedFormat('j F Y') }}</td>
                    <td class="py-3 px-3 text-center">{{ \Carbon\Carbon::parse($intern->selesai)->locale('id')->translatedFormat('j F Y') }}</td>
                    <td class="py-2 px-3">
                        <div class="flex align-center justify-center gap-2">
                            <flux:modal.trigger name="edit-intern">
                                <flux:button icon="ellipsis-horizontal" size="sm" wire:click="edit({{ $intern->id }})" />
                            </flux:modal.trigger>
    
                            <flux:modal.trigger name="delete-intern">
                                <flux:button icon="trash" variant="danger" size="sm" wire:click="delete({{ $intern->id }})" />
                            </flux:modal.trigger>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
