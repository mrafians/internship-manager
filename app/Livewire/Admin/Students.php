<?php

namespace App\Livewire\Admin;

use Flux\Flux;
use Livewire\Component;
use App\Models\Student;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $nama, $nis, $gender, $alamat, $kontak, $email, $student_id;

    public function render()
    {
        return view('livewire.admin.students', [
            'students' => Student::paginate(6)
        ]);
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->nis = '';
        $this->gender = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'nis' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required',
        ]);

        Student::create($validated);

        $this->resetInputFields();

        Flux::modal('add-student')->close();
    }

    public function edit($id)
    {
        $post = Student::findOrFail($id);

        $this->student_id = $id;
        $this->nama = $post->nama;
        $this->nis = $post->nis;
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

        $post = Student::find($this->student_id);
        $post->update([
            'nama' => $this->nama,
            'nis' => $this->nis,
            'gender' => $this->gender,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
        ]);

        Flux::modal('edit-student')->close();
    }

    public function delete($id)
    {
        Student::find($id)->delete();
    }
}
