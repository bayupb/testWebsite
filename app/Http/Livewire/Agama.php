<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AgamaModel;
use Livewire\WithPagination;

class Agama extends Component
{
    public $agama, $agama_id,$nama_agama;
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
        $this->nama_agama = '';
    }
    public function closeModalData(){
        $this->openModal = false;
        $this->resetModal();
    }

    public function simpandata(){
        $this->validate([
            'nama_agama'    => 'required'
        ]);

        AgamaModel::updateOrCreate(['id'=> $this->agama_id ],
    [
        'nama_agama' => $this->nama_agama
    ]);

    session()->flash('message', $this->agama_id ? 'Berhasil mengubah data agama' :  'Berhasil menambahkan data agama');

    $this->closeModalData();
    $this->resetModal();
    }


    public function edit($id){
        $agama = AgamaModel::find($id);
        $this->agama_id = $agama->id;
        $this->nama_agama = $agama->nama_agama;

        $this->openModalData();
    }

    public function delete($id){
        $agama = AgamaModel::find($id);
        $agama->delete();
    }


    public function render()
    {

        // AgamaModel::agamaget()->paginate(2);
        return view('livewire.agama',
    [
        'Agama' => $this->search === null ? AgamaModel::getdata()->paginate(5):
        AgamaModel::where('nama_agama' , 'LIKE' , '%'.$this->search.'%')->paginate(5)
    ]);
    }
}
