<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JabatanModel;
use Livewire\WithPagination;

class Jabatan extends Component
{
    public $jabatan, $jabatan_id,$nama_jabatan;
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
        $this->nama_jabatan = '';
    }
    public function closeModalData(){
        $this->openModal = false;
        $this->resetModal();
    }

    public function simpandata(){
        $this->validate([
            'nama_jabatan'    => 'required'
        ]);

        JabatanModel::updateOrCreate(['id'=> $this->jabatan_id ],
    [
        'nama_jabatan' => $this->nama_jabatan
    ]);

    session()->flash('message', $this->jabatan_id ? 'Berhasil mengubah data jabatan' :  'Berhasil menambahkan data jabatan');

    $this->closeModalData();
    $this->resetModal();
    }


    public function edit($id){
        $jabatan = JabatanModel::find($id);
        $this->jabatan_id = $jabatan->id;
        $this->nama_jabatan = $jabatan->nama_jabatan;

        $this->openModalData();
    }

    public function delete($id){
        $jabatan = JabatanModel::find($id);
        $jabatan->delete();
    }
    public function render()
    {
        return view('livewire.jabatan',[
            'Jabatan' => $this->search === null ? JabatanModel::getdata()->paginate(5):
            JabatanModel::where('nama_jabatan' , 'LIKE' , '%'.$this->search.'%')->paginate(5)
        ]);
    }
}
