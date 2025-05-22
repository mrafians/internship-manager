<div class="flex h-auto w-full flex-1 flex-col gap-2 rounded-xl">

    <div class="flex justify-between">
        <div>
            <flux:heading size="xl">Students List</flux:heading>
            <flux:text size="lg">List siswa yang terdaftar di sekolah.</flux:text>
        </div>
        
        <flux:modal.trigger name="add-student">
            <flux:button class="self-end" wire:click="resetInputFields()">Tambah</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="add-student" class="w-144">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Tambah Siswa</flux:heading>
                <flux:text class="mt-2">Tambah data diri siswa</flux:text>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <flux:input label="Nama" placeholder="Nama Siswa" wire:model="nama" required />
                <flux:input label="Email" type="email" placeholder="user@example.com" wire:model="email" required />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <flux:input label="NIS" mask="99999" placeholder="XXXXX" wire:model="nis" />
                <flux:input label="Kontak" mask="9999999999999" placeholder="081234567890" wire:model="kontak" />
            </div>
            <flux:textarea label="Alamat" resize="none" rows="3" wire:model="alamat" />
            <flux:select label="Gender" placeholder="Select Gender" wire:model="gender" required>
                <flux:select.option value="L">Laki-laki</flux:select.option>
                <flux:select.option value="P">Perempuan</flux:select.option>
            </flux:select>
            <flux:button variant="primary" class="w-full" wire:click.prevent="store()">Tambah</flux:button>
        </div>
    </flux:modal>

    <flux:modal name="edit-student" class="w-144">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Edit Siswa</flux:heading>
                <flux:text class="mt-2">Edit data diri siswa</flux:text>
            </div>
            <flux:input type="hidden" wire:model="student_id"/>
            <div class="grid grid-cols-2 gap-3">
                <flux:input label="Nama" placeholder="Nama Siswa" wire:model="nama" required />
                <flux:input label="Email" type="email" placeholder="user@example.com" wire:model="email" required />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <flux:input label="NIS" mask="99999" placeholder="XXXXX" wire:model="nis" />
                <flux:input label="Kontak" mask="9999999999999" placeholder="0812-3456-7890" wire:model="kontak" />
            </div>
            <flux:textarea label="Alamat" resize="none" rows="3" wire:model="alamat" />
            <flux:select label="Gender" placeholder="Select Gender" wire:model="gender" required>
                <flux:select.option value="L">Laki-laki</flux:select.option>
                <flux:select.option value="P">Perempuan</flux:select.option>
            </flux:select>
            <flux:button variant="primary" class="w-full" wire:click.prevent="update()">Simpan</flux:button>
        </div>
    </flux:modal>

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full dark:text-gray-100">
            <thead class="text-gray-100 uppercase">
                <tr class="dark:bg-[#181818]">
                    <th class="px-2 py-2">Nama</th>
                    <th class="px-2 py-2">Email</th>
                    <th class="px-2 py-2">NIS</th>
                    <th class="px-2 py-2">Kontak</th>
                    <th class="px-2 py-2">Gender</th>
                    <th class="px-2 py-2">Status PKL</th>
                    <th class="px-2 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr class="border-t dark:border-[#555555] text-sm">
                    <td class="py-3 px-6">{{ $student->nama }}</td>
                    <td class="py-3 px-6">{{ $student->email }}</td>
                    <td class="py-3 px-6 text-center">{{ $student->nis }}</td>
                    <td class="py-3 px-6 text-center">{{ $student->kontak }}</td>
                    <td class="py-3 px-6 text-center">
                        @if ($student->gender == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td>
                        <div class="flex justify-center">
                            @if ($student->status_pkl == 1)
                                <flux:icon.check-circle variant="solid" class="text-green-400" />
                            @else
                                <flux:icon.x-circle variant="solid" class="text-red-400" />
                            @endif
                        </div>
                    </td>
                    <td class="py-2 px-3">
                        <div class="flex align-center justify-center gap-2">
                            <flux:modal.trigger name="edit-student">
                                <flux:button icon="ellipsis-horizontal" size="sm" wire:click="edit({{ $student->id }})" />
                            </flux:modal.trigger>
    
                            <flux:modal.trigger name="delete-student">
                                <flux:button icon="trash" variant="danger" size="sm" wire:click="delete({{ $student->id }})" />
                            </flux:modal.trigger>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $students->links() }}
</div>
