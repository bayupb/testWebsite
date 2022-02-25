<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GolonganModel;

class Golongan extends Component
{
    public $golongan, $golongan_id,$nama_golongan;
    public $search;
    public $openModal = 0;
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModalData(){
        $this->openModal = true;
    }
    public function resetModal(){
        $this->nama_golongan = '';
    }
    public function closeModalData(){
        $this->openModal = false;
        $this->resetModal();
    }

    public function simpandata(){
        $this->validate([
            'nama_golongan'    => 'required'
        ]);

        GolonganModel::updateOrCreate(['id'=> $this->golongan_id ],
    [
        'nama_golongan' => $this->nama_golongan
    ]);

    session()->flash('message', $this->golongan_id ? 'Berhasil mengubah data golongan' :  'Berhasil menambahkan data golongan');

    $this->closeModalData();
    $this->resetModal();
    }


    public function edit($id){
        $golongan = GolonganModel::find($id);
        $this->golongan_id = $golongan->id;
        $this->nama_golongan = $golongan->nama_golongan;

        $this->openModalData();
    }

    public function delete($id){
        $agama = GolonganModel::find($id);
        $agama->delete();
    }
    public function render()
    {
        return view('livewire.golongan',[
            'Golongan' => $this->search === null ? GolonganModel::getdata()->paginate(5):
            GolonganModel::where('nama_golongan' , 'LIKE' , '%'.$this->search.'%')->paginate(5)
        ]);
    }
}
