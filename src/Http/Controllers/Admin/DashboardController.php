<?php 
namespace Uzaweb\Openexam\Http\Controllers\Admin;

use Illuminate\Routing\Controller; 
use Uzaweb\Openexam\Models\Dashboard;

use Uzaweb\Openexam\Http\Requests\DashboardRequest;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
     public function __construct()
    {
    }
      
    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {   
    	$dashboards = Dashboard::all();
        return view('openexam::admin.dashboard.index', compact('dashboards'));                   
    }
    
    public function get()
    {
        $selected = Dashboard::select('id','title','detail','created_at','updated_at');        
        return DataTables::of($selected)
            ->editColumn('created_at', function ($data) {
                return $data->created_at;
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at;
            })
            ->addColumn('action',function($selected){
                $editUrl = route('admin.openexam.dashboard.edit', $selected->id);
                $destroyUrl = route('admin.openexam.dashboard.destroy', $selected->id);                
                return
                '<button type="button" class="btn btn-info btn-sm btnEdit" data-edit="' . $editUrl . '">Edit</button>
                <button type="submit" class="btn btn-warning btn-sm btnDelete" data-remove="' . $destroyUrl . '">Delete</button>';
            })
            ->make(true);        
    }
        
    
    /**
     * Store a newly itemes.
     *
     * @param DashboardRequest $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(DashboardRequest $request)
    {     
        $dashboard = new Dashboard();
        $dashboard->title = $request->title;
        $dashboard->detail = $request->detail;
        
        $dashboard->save();
        return response()->json(array("success"=>true));
    }
    
    public function edit($id)
    {
        $data = Dashboard::find($id);
        return response()->json($data);
    }
    
    /**
     * Update the specified itemes.
     *
     * @param DashboardRequest $request     
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DashboardRequest $request, $id)
    { 
        $dashboard = Dashboard::find($id);
        $dashboard->title = $request->title;
        $dashboard->detail = $request->detail;        
        $dashboard->save();
        return response()->json(array("success"=>true));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Dashboard::destroy($id)) {
            $data = 'Success';
        }else{
            $data = 'Failed';
        }
        return response()->json($data);
    }
    

    
}

