<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\SizeChart;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class MasterManagementController extends BaseController
{
    function __construct()
    {
        $this->size_chart = new SizeChart();
    }

    public function size_chart()
    {
        $title = 'Size Chart';
        $js = 'assets/js/apps/master/size_chart.js?_='.rand();
        return view('master.size_chart', compact('js', 'title'));
    }

    public function datatable_size_chart()
    {
        $data = $this->size_chart->dataTableSizeChart(); 
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'MS1', $row)) {
                    if($row->status == 1) {
                        $btn = '<a class="btn btn-danger btn-sm" onclick="deactivate(\'' . $row->id . '\')"><em class="icon ni ni-cross-c"></em><span>Non Activate</span></a>';
                    }else{
                        $btn = '<a class="btn btn-primary btn-sm" onclick="activate(\'' . $row->id . '\')"><em class="icon ni ni-check-c"></em><span>Activate</span></a>';
                    }
                }
                return $btn;
            })
            ->make(true);
    }

    public function store_size_chart(Request $request)
    {
        $id = $request->input('id_size_chart');

        $validator = Validator::make($request->all(), [
            'ukuran' => 'required|max:5|unique:size_chart,nama,'.$id,
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $data = [
            'nama' => $request->ukuran,
        ];

        $process = SizeChart::updateOrCreate(['id' => $id], $data);

        if($process) {
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        }else{
            return $this->ajaxResponse(false, 'Data gagal disimpan');
        }
    }

    public function edit_size_chart(Request $request) 
    {
        $id = $request->id;
        $data = DB::table('size_chart')->where('id', $id)->select('id', 'nama')->first();
        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function delete_size_chart(Request $request)
    {
        $id = $request->id;
        $process = DB::table('size_chart')->where('id', $id)->delete();

        if($process) {
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        }else{
            return $this->ajaxResponse(false, 'Data gagal dihapus');
        }
    }

    public function activate_size_chart(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id     = $request->id;

            SizeChart::where('id', $id)->update(['status' => 1]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }

    public function deactivate_size_chart(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id     = $request->id;

            SizeChart::where('id', $id)->update(['status' => 0]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }
}
