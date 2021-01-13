<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Drug\DrugResource;
use App\Http\Resources\Admin\Drug\ShowDrugResource;
use App\Http\Traits\FileTrait;

class DrugController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::with('category')->orderBy('name', 'desc');
        $drugs = $this->filter($drugs);
        $drugs = $drugs->paginate(config('kashf.pagination_per_page'));
        $drugs = DrugResource::collection($drugs);
        $drugs->withPath(url()->full());
        $drugs = customPagination($drugs, 'drugs');

        return $drugs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $drug = Drug::create([
            'name' => $request->name,
            'scientific_name' => $request->scientific_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => '',
        ]);
        $imageName = $this->uploadImageBase64($request->image, drugPath(), $drug->id);
        $drug->update([
            'image' => $imageName
        ]);
        return new ShowDrugResource($drug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        return new ShowDrugResource($drug->load('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        return new ShowDrugResource($drug->load('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        $imageName = $this->uploadImageBase64($request->image, drugPath(), $drug->id);

        $drug->update([
            'name' => $request->name,
            'scientific_name' => $request->scientific_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imageName ?? $drug->image,
        ]);

        return new ShowDrugResource($drug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Drug $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();
        return true;

    }

    public function filter($drugs)
    {
        if (request()->name) {
            $drugs->where('name', 'like', request('name') . "%");
        }

        if (request()->scientific_name) {
            $drugs->where('scientific_name', 'like', request('scientific_name') . "%");
        }

        if (isset(request()->category_id)) {
            $drugs->where('category_id', request('category_id'));
        }

        if (isset(request()->price)) {
            $drugs->where('price', request('price'));
        }

        return $drugs;
    }
}
