<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminBaseController;

class AreaController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('name', 'desc');
        $areas = $this->filter($areas);
        $areas = $areas->paginate(config('kashf.pagination_per_page'));
        $areas->withPath(url()->full());
        $areas = customPagination($areas, 'areas');
        return $areas;

    }

    public function getAll()
    {
        return Area::get(['id', 'name']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = Area::create([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return $area;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return $area;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $area->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return $area;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return true;
    }

    public function filter($areas)
    {

        if (isset(request()->status)) {
            $areas->where('status', request('status'));
        }

        return $areas;
    }
}
