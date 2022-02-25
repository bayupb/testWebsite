<?php

namespace App\Http\Livewire;

use PDF;
use Livewire\Component;
use App\Models\AgamaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use Livewire\WithPagination;
use App\Models\GolonganModel;
use Livewire\WithFileUploads;
use App\Models\PenempatanModel;
use Illuminate\Support\Facades\File;

class Pegawai extends Component
{
    public $gambar_pegawai,$nip_pegawai, $nama_pegawai , $tempat_lahir_pegawai, $id_golongan, $alamat_pegawai,
            $tanggal_lahir_pegawai , $jenis_kelamin_pegawai, $id_penempatan , $eselon,
            $id_agama , $jabatan_id, $pegawai, $pegawai_id, $gambar_pegawai_lama , $unit_kerja , $npwp, $no_hp;

    public $search;
    public $openModal = 0;
    use WithPagination;
    use WithFileUploads;

    public $filterjeniskelamin = null;
    public $Filterpenempatan = null;
    public $filteragama = null;
    public $Filterjabatan = null;
    public $filtergolongan = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModalData(){
        $this->openModal = true;
    }
    public function resetModal(){
        $this->gambar_pegawai = null;
        $this->nip_pegawai = '';
        $this->nama_pegawai = '';
        $this->tempat_lahir_pegawai = '';
        $this->alamat_pegawai = '';
        $this->tanggal_lahir_pegawai = '';
        $this->jenis_kelamin_pegawai = '';
        $this->id_golongan = '';
        $this->id_penempatan = '';
        $this->id_agama = '';
        $this->jabatan_id = '';
        $this->no_hp = '';
        $this->npwp = '';
        $this->unit_kerja = '';
        $this->eselon = '';
    }
    public function closeModalData(){
        $this->openModal = false;
        $this->resetModal();
    }

    public function simpandata(){

        $gambar = '';
        if($this->gambar_pegawai != $this->gambar_pegawai_lama){
            $gambar = 'nullable|image|max:2048|mimes:jpg,png';
        }
        $this->validate([
            'nama_pegawai'    => 'nullable',
            'nip_pegawai'    => 'nullable',
            'tempat_lahir_pegawai'    => 'nullable',
            'alamat_pegawai'    => 'nullable',
            'tanggal_lahir_pegawai'    => 'nullable',
            'jenis_kelamin_pegawai'    => 'nullable',
            'id_golongan'    => 'nullable',
            'id_penempatan'    => 'nullable',
            'id_agama'    => 'nullable',
            'jabatan_id'    => 'nullable',
            'gambar_pegawai'    => $gambar,
            'npwp'          => 'nullable',
            'no_hp'         => 'nullable',
            'unit_kerja'    => 'nullable',
            'eselon'    => 'nullable'
        ]);

        if($this->gambar_pegawai != $this->gambar_pegawai_lama){
            $fileImages = public_path('\storage\\').$this->gambar_pegawai;
                if(File::exists($fileImages)){
                    File::delete($fileImages);
                }
            $fileGambar = $this->gambar_pegawai->store('pegawai-gambar', 'public');
        }else{
            $fileGambar = $this->gambar_pegawai;
        }

        PegawaiModel::updateOrCreate(['id'=> $this->pegawai_id ],
    [
        'nama_pegawai'    => $this->nama_pegawai,
        'nip_pegawai'    => $this->nip_pegawai,
        'tempat_lahir_pegawai'    => $this->tempat_lahir_pegawai,
        'alamat_pegawai'    => $this->alamat_pegawai,
        'tanggal_lahir_pegawai'    => $this->tanggal_lahir_pegawai,
        'jenis_kelamin_pegawai'    => $this->jenis_kelamin_pegawai,
        'id_golongan'    => $this->id_golongan,
        'id_penempatan'    => $this->id_penempatan,
        'id_agama'    => $this->id_agama,
        'jabatan_id'    => $this->jabatan_id,
        'gambar_pegawai'    => $fileGambar,
        'npwp'          => $this->npwp,
        'no_hp'         => $this->no_hp,
        'unit_kerja'    => $this->unit_kerja,
        'eselon'    => $this->eselon
    ]);

    session()->flash('message', $this->pegawai_id ? 'Berhasil mengubah data pegawai' :  'Berhasil menambahkan data pegawai');

    $this->closeModalData();
    $this->resetModal();
    }

    public function cetakpegawai(){
        $cetak_pegawai = PegawaiModel::latest()->get();
        $agama = AgamaModel::get();
        $jabatan = JabatanModel::get();
        $penempatan = PenempatanModel::get();
        $golongan = GolonganModel::get();
        $pdf = PDF::loadview('livewire.cetak.cetakpegawai',compact('cetak_pegawai' , 'agama' , 'jabatan' , 'penempatan' , 'golongan'))->output();
        // return $pdf->stream();
        return response()->streamDownload(
            fn()=> print($pdf),
            "data_pegawai.pdf"
        );
        // $this->openModalData();
    }


    public function edit($id){
        $pegawai = PegawaiModel::findorFail($id);
        $this->pegawai_id = $pegawai->id;
        $this->jabatan_id = $pegawai->jabatan_id;
        $this->nama_pegawai = $pegawai->nama_pegawai;
        $this->nip_pegawai = $pegawai->nip_pegawai;
        $this->eselon = $pegawai->eselon;
        $this->tempat_lahir_pegawai = $pegawai->tempat_lahir_pegawai;
        $this->tanggal_lahir_pegawai = $pegawai->tanggal_lahir_pegawai;
        $this->jenis_kelamin_pegawai = $pegawai->jenis_kelamin_pegawai;
        $this->id_golongan = $pegawai->id_golongan;
        $this->id_penempatan = $pegawai->id_penempatan;
        $this->id_agama = $pegawai->id_agama;
        $this->gambar_pegawai = $pegawai->gambar_pegawai;
        $this->gambar_pegawai_lama = $pegawai->gambar_pegawai;
        $this->npwp = $pegawai->npwp;
        $this->alamat_pegawai = $pegawai->alamat_pegawai;
        $this->no_hp = $pegawai->no_hp;
        $this->unit_kerja = $pegawai->unit_kerja;

        $this->openModalData();
    }

    public function delete($id){
        $pegagawai = PegawaiModel::find($id);
        $file_gambar = public_path('\storage\\').$this->gambar_pegawai;
        if(File::exists($file_gambar)){
            File::delete($file_gambar);
        }
        $pegagawai->delete();
    }

    public function render()
    {
        // $pegawai = PegawaiModel::with(['jabatan' , 'agama' ,'golongan', 'penempatan'])->get();
        // $golongan = GolonganModel::orberBY('desc')->get();
        // $jabatan = JabatanModel::getdata()->get();
        $agama = AgamaModel::get();
        $jabatan = JabatanModel::get();
        $penempatan = PenempatanModel::get();
        $golongan = GolonganModel::get();

        $pegawai = PegawaiModel::orderBy('created_at','desc')->paginate(5);

        if(strlen($this->search) > 0 ) {
             if($this->Filterjabatan){
                 $pegawai = $this->search === null ? PegawaiModel::latest()->paginate(5) :
                 PegawaiModel::where('jabatan_id' , 'LIKE' , '%'.$this->search.'%')
                                ->where('jabatan_id',$this->Filterjabatan)
                                ->paginate(5);
             }
             elseif($this->Filterpenempatan){
                 $pegawai = $this->search === null ? PegawaiModel::latest()->paginate(5) :
                 PegawaiModel::where('id_penempatan' , 'LIKE' , '%'.$this->search.'%')
                                ->where('id_penempatan',$this->Filterpenempatan)
                                ->paginate(5);
             }
             elseif($this->filteragama){
                 $pegawai = $this->search === null ? PegawaiModel::latest()->paginate(5) :
                 PegawaiModel::where('id_agama' , 'LIKE' , '%'.$this->search.'%')
                                ->where('id_agama',$this->filteragama)
                                ->paginate(5);
             }
                else{
                 $pegawai = PegawaiModel::where('nama_pegawai' , 'LIKE' , '%'.$this->search.'%')
                                ->paginate(5);
             }
         }
         elseif($this->Filterjabatan){
              $pegawai = $this->Filterjabatan === null ? PegawaiModel::latest()->get() :
                PegawaiModel::where('jabatan_id' ,$this->Filterjabatan)->paginate(5);
         }
         elseif($this->Filterpenempatan){
              $pegawai = $this->Filterpenempatan === null ? PegawaiModel::latest()->get() :
                PegawaiModel::where('id_penempatan' ,$this->Filterpenempatan)->paginate(5);
         }
         elseif($this->filteragama){
              $pegawai = $this->filteragama === null ? PegawaiModel::latest()->get() :
                PegawaiModel::where('id_agama' ,$this->filteragama)->paginate(5);
         }
         elseif($this->filtergolongan){
              $pegawai = $this->filtergolongan === null ? PegawaiModel::latest()->get() :
                PegawaiModel::where('id_golongan' ,$this->filtergolongan)->paginate(5);
         }
         elseif($this->filterjeniskelamin){
              $pegawai = $this->filterjeniskelamin === null ? PegawaiModel::latest()->get() :
                PegawaiModel::where('jenis_kelamin_pegawai' , 0 ,$this->filterjeniskelamin)->paginate(5);

         }else{
             $pegawai = PegawaiModel::where('nama_pegawai' , 'LIKE' , '%'.$this->search.'%')
                                ->paginate(5);
         }


        return view('livewire.pegawai',
    [
        'Agama'  => $agama,
        'Jabatan'  => $jabatan,
        'Penempatan'  => $penempatan,
        'Golongan'  => $golongan,
         'Pegawai' => $pegawai,

    ]);
    }
}
