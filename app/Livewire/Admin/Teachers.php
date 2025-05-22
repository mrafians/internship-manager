<?php

namespace App\Livewire\Admin;

use Flux\Flux;
use Livewire\Component;
use App\Models\Teacher;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Teachers extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $nama, $nip, $gender, $alamat, $kontak, $email, $teacher_id;

    public function render()
    {
        return view('livewire.admin.teachers', [
            'teachers' => Teacher::paginate(6)
        ]);
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->nip = '';
        $this->gender = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'nip' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required',
        ]);

        Teacher::create($validated);

        $this->resetInputFields();

        Flux::modal('add-teacher')->close();
    }

    public function edit($id)
    {
        $post = Teacher::findOrFail($id);

        $this->teacher_id = $id;
        $this->nama = $post->nama;
        $this->nip = $post->nip;
        $this->gender = $post->gender;
        $this->alamat = $post->alamat;
        $this->kontak = $post->kontak;
        $this->email = $post->email;
    }

    public function update()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'email' => 'required',
            'gender' => 'required',
        ]);

        $post = Teacher::find($this->teacher_id);
        $post->update([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'gender' => $this->gender,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
        ]);

        Flux::modal('edit-teacher')->close();
    }

    public function delete($id)
    {
        Teacher::find($id)->delete();
    }
}
