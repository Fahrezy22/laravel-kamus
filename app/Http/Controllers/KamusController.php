<?php

namespace App\Http\Controllers;

use App\Imports\ImportKata;
use App\Models\Kata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KamusController extends Controller
{
    public function index(Request $request)
    {
        $data = Kata::all();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button href="#" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-md editItem"><i class="fas fa-edit"></i></button>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger deleteItem"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.kata');
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $index = Str::substr($request->indonesia, 0, 1);

        $data = Kata::updateOrCreate(
            ['id' => $id],
            [
                'index' => $index,
                'indonesia' => $request->indonesia,
                'daerah' => $request->daerah,
                'jenis' => $request->jenis,
            ]
        );

        return response()->json($data);
    }

    public function edit($id)
    {
        $item = Kata::find($id);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Kata::find($id)->delete();

        Alert::success('Hapus Data', 'Data berhasil di hapus!');
        return back();
    }

    public function translate()
    {
        $data = Kata::all();
        return view('public.indonesia')->with('data', $data);
    }

    public function search(Request $request)
    {
        $text = $request->search;
        $result = DB::table('katas')->where('indonesia', 'Like', "$text")->first();
        $result_id = $result->id;
        $data = DB::table('katas')->where('indonesia', 'Like', "$text")->first();
        $data2 = DB::table('katas')->where([['indonesia', 'Like', "%$text%"], ['id', '!=', $result_id]])->get();

        return response()->json([$data, $data2]);
    }

    public function translate2()
    {
        $data = Kata::all();
        return view('public.daerah')->with('data', $data);
    }

    public function search2(Request $request)
    {
        $text = $request->search;
        $result = DB::table('katas')->where('daerah', 'Like', "$text")->first();
        $result_id = $result->id;
        $data = DB::table('katas')->where('daerah', 'Like', "$text")->first();
        $data2 = DB::table('katas')->where([['daerah', 'Like', "%$text%"], ['id', '!=', $result_id]])->get();

        return response()->json([$data, $data2]);
    }

    public function import(Request $request){

        Excel::import(new ImportKata, $request->file('excel'));
        return redirect()->back();
    }
}
