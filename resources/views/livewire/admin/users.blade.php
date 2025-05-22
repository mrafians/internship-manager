<div class="flex h-auto w-full flex-1 flex-col gap-2 rounded-xl">

    <div class="flex justify-between">
        <div>
            <flux:heading size="xl">Users List</flux:heading>
            <flux:text size="lg">List users yang terdaftar di database.</flux:text>
        </div>
        
        <flux:modal.trigger name="add-user">
            <flux:button class="self-end" wire:click="resetInputFields()">Tambah</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="add-user" class="w-96">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Tambah User</flux:heading>
                <flux:text class="mt-2">Tambah data diri pengguna.</flux:text>
            </div>
            <flux:input label="Username" placeholder="Username" wire:model="name" required />
            <flux:input label="Email" type="email" placeholder="user@example.com" wire:model="email" required />
            <flux:input label="Password" type="password" placeholder="min. 8 characters" wire:model="password" required />
            <flux:select label="Role" placeholder="Select Roles" wire:model="roles" required>
                <flux:select.option value="admin">Admin</flux:select.option>
                <flux:select.option value="siswa">Siswa</flux:select.option>
                <flux:select.option value="guru">Guru</flux:select.option>
            </flux:select>
            <flux:button variant="primary" class="w-full" wire:click.prevent="store()">Tambah</flux:button>
        </div>
    </flux:modal>

    <flux:modal name="edit-user" class="w-96">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Tambah User</flux:heading>
                <flux:text class="mt-2">Tambah data diri pengguna.</flux:text>
            </div>
            <flux:input type="hidden" wire:model="user_id"/>
            <flux:input label="Username" placeholder="Username" wire:model="name" required />
            <flux:input label="Email" type="email" placeholder="user@example.com" wire:model="email" required />
            <flux:input label="Password" type="password" placeholder="Kosongkan jika tidak diubah" wire:model="password" required />
            <flux:select label="Role" placeholder="Select Roles" wire:model="roles" required>
                <flux:select.option value="admin">Admin</flux:select.option>
                <flux:select.option value="siswa">Siswa</flux:select.option>
                <flux:select.option value="guru">Guru</flux:select.option>
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
                    <th class="px-2 py-2">Role</th>
                    <th class="px-2 py-2">Created</th>
                    <th class="px-2 py-2">Updated</th>
                    <th class="px-2 py-2">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t dark:border-[#555555] text-sm">
                    <td class="py-3 px-6">{{ $user->name }}</td>
                    <td class="py-3 px-6">{{ $user->email }}</td>
                    <td class="px-6 text-center">
                        @if ($user->roles == 'admin')
                            <flux:badge color="amber" size="sm">admin</flux:badge>
                        @elseif ($user->roles == 'siswa')
                            <flux:badge color="sky" size="sm">siswa</flux:badge>
                        @elseif ($user->roles == 'guru')
                            <flux:badge color="emerald" size="sm">guru</flux:badge>
                        @else
                            <flux:badge color="red" size="sm">invalid</flux:badge>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->diffForHumans() }}</td>
                    <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($user->updated_at)->locale('id')->diffForHumans() }}</td>
                    <td class="py-2 px-3">
                        <div class="flex align-center justify-center gap-2">
                            <flux:modal.trigger name="edit-user">
                                <flux:button icon="ellipsis-horizontal" size="sm" wire:click="edit({{ $user->id }})" />
                            </flux:modal.trigger>
    
                            <flux:modal.trigger name="delete-user">
                                <flux:button icon="trash" variant="danger" size="sm" wire:click="delete({{ $user->id }})" />
                            </flux:modal.trigger>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
