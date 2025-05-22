<?php

namespace App\Livewire\Admin;

use App\Models\Industry;
use App\Models\Internship;
use App\Models\Student;
use App\Models\Teacher;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Internships extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $siswa_id, $guru_id, $industri_id, $mulai, $selesai, $intern_id;
    public $daftarSiswa = [];
    public $daftarIndustri = [];
    public $daftarGuru = [];

    public function mount()
    {
        $this->daftarSiswa = Student::all();
        $this->daftarIndustri = Industry::all();
        $this->daftarGuru = Teacher::all();
    }

    public function render()
    {
        return view('livewire.admin.internships', [
            'internships' => Internship::with('siswa', 'guru', 'industri')->paginate(6)
        ]);
    }

    public function resetInputFields()
    {
        $this->siswa_id = '';
        $this->industri_id = '';
        $this->guru_id = '';
        $this->mulai = '';
        $this->selesai = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'siswa_id' => 'required|exists:students,id',
            'industri_id' => 'required|exists:industries,id',
            'guru_id' => 'required|exists:teachers,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        Internship::create($validated);

        $this->resetInputFields();

        Flux::modal('add-intern')->close();
    }

    public function edit($id)
    {
        $post = Internship::findOrFail($id);

        $this->intern_id = $id;
        $this->siswa_id = $post->siswa_id;
        $this->industri_id = $post->industri_id;
        $this->guru_id = $post->guru_id;
        $this->mulai = $post->mulai;
        $this->selesai = $post->selesai;
    }

    public function update()
    {
        $validated = $this->validate([
            'siswa_id' => 'required',
            'industri_id' => 'required',
            'guru_id' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $post = Internship::find($this->intern_id);
        $post->update([
            'siswa_id' => $this->siswa_id,
            'industri_id' => $this->industri_id,
            'guru_id' => $this->guru_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        Flux::modal('edit-intern')->close();
    }

    public function delete($id)
    {
        Internship::find($id)->delete();
    }
}
