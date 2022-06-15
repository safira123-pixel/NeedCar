<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MerkController extends Controller
{

    public function __construct()
    {
        $this->merk = new Merk();
    }

    public function index()
    {
        return view('merk.index');
    }

    public function source(){
        $query= Merk::query();
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                });
            }
            })
            ->addColumn('name', function ($data) {
                return title_case($data->name);
            })
            ->addIndexColumn()
            ->addColumn('action', 'merk.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.merk.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $requset = $request->merge(['slug'=>$request->name]);
            $this->merk->create($request->all());
            DB::commit();
            return redirect()->route('merk.index')->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->merk->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->merk->find($id);
        return view('merk.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=>$request->name]);
            $this->merk->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('merk.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->merk->destroy($id);
        return redirect()->route('merk.index')->with('success-message','Data telah dihapus');
    }

    public function getmerk(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->merk->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }

    public function find($id){
        return $this->merk->find($id);
    }

}
