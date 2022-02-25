<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PenempatanModel;

class Penempatan extends Component
{
    public $penempatan, $penempatan_id,$nama_penempatan;
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
        $this->nama_penempatan = '';
    }
    public function closeModalData(){
        $this->openModal = false;
        $this->resetModal();
    }

    public function simpandata(){
        $this->validate([
            'nama_penempatan'    => 'required'
        ]);

        PenempatanModel::updateOrCreate(['id'=> $this->penempatan_id ],
    [
        'nama_penempatan' => $this->nama_penempatan
    ]);

    session()->flash('message', $this->penempatan_id ? 'Berhasil mengubah data penempatan' :  'Berhasil menambahkan data penempatan');

    $this->closeModalData();
    $this->resetModal();
    }


    public function edit($id){
        $penempatan = PenempatanModel::find($id);
        $this->penempatan_id = $penempatan->id;
        $this->nama_penempatan = $penempatan->nama_penempatan;

        $this->openModalData();
    }

    public function delete($id){
        $penempatan = PenempatanModel::find($id);
        $penempatan->delete();
    }
    public function render()
    {
        return view('livewire.penempatan',[
            'Penempatan' => $this->search === null ? PenempatanModel::getdata()->paginate(5):
            PenempatanModel::where('nama_penempatan' , 'LIKE' , '%'.$this->search.'%')->paginate(5)
        ]);
    }
}
