<?php

namespace App\Livewire\Admin;

use App\Models\Industry;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Industries extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $nama, $bidang_usaha, $alamat, $kontak, $email, $website, $industry_id;

    public function render()
    {
        return view('livewire.admin.industries', [
            'industries' => Industry::paginate(6)
        ]);
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->bidang_usaha = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
        $this->website = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        Industry::create($validated);

        $this->resetInputFields();

        Flux::modal('add-industry')->close();
    }

    public function edit($id)
    {
        $post = Industry::findOrFail($id);

        $this->industry_id = $id;
        $this->nama = $post->nama;
        $this->bidang_usaha = $post->bidang_usaha;
        $this->alamat = $post->alamat;
        $this->kontak = $post->kontak;
        $this->email = $post->email;
        $this->website = $post->website;
    }

    public function update()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'bidang_usaha' => 'required',
            'email' => 'required',
        ]);

        $post = Industry::find($this->industry_id);
        $post->update([
            'nama' => $this->nama,
            'bidang_usaha' => $this->bidang_usaha,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        Flux::modal('edit-industry')->close();
    }

    public function delete($id)
    {
        Industry::find($id)->delete();
    }
}
