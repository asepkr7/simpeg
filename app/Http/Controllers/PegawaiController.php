<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
   public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        return view('pegawai.index',[
            'title' => 'Pegawai',
            'pegawai' => Pegawai::orderBy('nama')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'regex:/^[A-Za-z\'\s]+$/'],
            'nip' => 'required|numeric',
            'gelar_depan' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'gelar_belakang' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'tempat_lahir' => 'required|alpha',
            'tanggal_lahir' =>'required|date',
            'gender' => 'required|in:l,p',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'gol_darah' => 'nullable|string',
            'status_pernikahan' => 'nullable|required',
            'nik' => 'required|numeric',
            'telp' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{11}$/',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'npwp' => 'nullable|string',
            'bpjs' => 'nullable|string',
            'karpeg' =>'required',
            'status_kepegawaian' => 'required|in:PNS, PPPK,TKK,HONORER,CPNS,Magang',
            'no_sk_cpns' => 'required',
            'tmt_sk_cpns' => 'required',
            'no_sk_pns' =>'required',
            'tmt_sk_pns' => 'required',
            'tpp'   => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
         if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images');
        }
        Pegawai::create($validatedData);
        return redirect('/petugas/data-pegawai')->with('success', 'Data Pegawai Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $data_pegawai)
    {
        return view('pegawai.edit',[
            'data_pegawai' => $data_pegawai,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $data_pegawai)
    {
         $validatedData = $request->validate([
            'nama' => ['required', 'regex:/^[A-Za-z\'\s]+$/'],
            'nip' => 'required|numeric',
            'gelar_depan' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'gelar_belakang' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'tempat_lahir' => 'required|alpha',
            'tanggal_lahir' =>'required|date',
            'gender' => 'required|in:l,p',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'gol_darah' => 'nullable|string',
            'status_pernikahan' => 'nullable|required',
            'nik' => 'required|numeric',
            'telp' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{11}$/',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'npwp' => 'nullable|string',
            'bpjs' => 'nullable|string',
            'karpeg' =>'required',
            'status_kepegawaian' => 'required|in:PNS, PPPK,TKK,HONORER,CPNS,Magang',
            'no_sk_cpns' => 'required',
            'tmt_sk_cpns' => 'required',
            'no_sk_pns' =>'required',
            'tmt_sk_pns' => 'required',
            'tpp'   => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
         if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        Pegawai::where('id_pegawai',$data_pegawai->id_pegawai)
        ->update($validatedData);

        return redirect('/petugas/data-pegawai')->with('edit', 'Data Pegawai Berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $data_pegawai)
    {
        if ($data_pegawai->image) {
                Storage::delete($data_pegawai->image);
            }
            Pegawai::destroy($data_pegawai->id_pegawai);
            return redirect('/petugas/data-pegawai')->with('delete', 'Data Pegawai Berhasil dihapus');
    }
}
