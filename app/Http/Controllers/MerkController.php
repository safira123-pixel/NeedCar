<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MerkController extends Controller
{

public function index()
{
//fungsi eloquent menampilkan data menggunakan pagination
$data = array('title' => 'Car Merk Data');
$merk = Merk::all(); // Mengambil semua isi tabel
$paginate = Merk::orderBy('id', 'asc')->paginate(3);
return view('merk.index', ['merk' => $merk,'paginate'=>$paginate], $data);
}

public function create()
{
$data = array('title' => 'Data Create Merk');
return view('merk.create', $data);
}

public function store(Request $request)
{
//melakukan validasi data
$request->validate([
'Code' => 'required',
'Name' => 'required',
'Slug' => 'required',
'Description' => 'required',
'Status' => 'required',
]);
//fungsi eloquent untuk menambah data
$merk = new Merk;
    $merk->merk_code = $request->get('Code');
    $merk->merk_name = $request->get('Name');
    $merk->merk_slug = $request->get('Slug');
    $merk->merk_description = $request->get('Description');
    $merk->merk_status = $request->get('Status');
    $merk->save();
    //jika data berhasil ditambahkan, akan kembali ke halaman utama
return redirect()->route('merk.index')
->with('success', 'Merk Added');
}

public function show($id)
{
//menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
$data = array('title' => 'Data Show Merk');
$Merk = Merk::where('id', $id)->first();
return view('merk.detail', compact('Merk'), $data);
}

public function edit($id)
{
//menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
$data = array('title' => 'Data Edit Merk');
$Merk = DB::table('merk')->where('id', $id)->first();
return view('merk.edit', compact('Merk'), $data);
}

public function update(Request $request, $id)
{
//melakukan validasi data
$request->validate([
    'Code' => 'required',
    'Name' => 'required',
    'Slug' => 'required',
    'Description' => 'required',
    'Status' => 'required',
]);
//fungsi eloquent untuk mengupdate data inputan kita
$merk = Merk::where('id', $id)->first;
    $merk->merk_code = $request->get('Code');
    $merk->merk_name = $request->get('Name');
    $merk->merk_slug = $request->get('Slug');
    $merk->merk_description = $request->get('Description');
    $merk->merk_status = $request->get('Status');

    $merk->save();

//jika data berhasil diupdate, akan kembali ke halaman utama
return redirect()->route('merk.index')
->with('success', 'Merk Updated!');
}

public function destroy( $id)
{
//fungsi eloquent untuk menghapus data
Merk::where('id', $id)->delete();
return redirect()->route('merk.index')
-> with('success', 'Merk Deleted!');
}

}
