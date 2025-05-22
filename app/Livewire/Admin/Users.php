<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Flux\Flux;
use Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $email, $password, $roles, $user_id;

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::paginate(6)
        ]);
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->roles = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required',
        ]);

        User::create($validated);

        $this->resetInputFields();

        Flux::modal('add-user')->close();
    }

    public function edit($id)
    {
        $post = User::findOrFail($id);

        $this->user_id = $id;
        $this->name = $post->name;
        $this->email = $post->email;
        $this->password = '';
        $this->roles = $post->roles;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:8',
            'roles' => 'required',
        ]);

        $post = User::find($this->user_id);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
        ];

        if (!empty($this->password)) {
            $updateData['password'] = Hash::make($this->password);
        }
        
        $post->update($updateData);

        Flux::modal('edit-user')->close();
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
}
