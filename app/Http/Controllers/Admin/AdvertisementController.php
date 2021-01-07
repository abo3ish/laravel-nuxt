<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Resources\Admin\Advertisement\AdvertisementResource;
use App\Http\Traits\FileTrait;

class AdvertisementController extends AdminBaseController
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::orderBy('slug', 'desc');
        $advertisements = $this->filter($advertisements);
        $advertisements = $advertisements->paginate(config('kashf.pagination_per_page'));
        $advertisements = AdvertisementResource::collection($advertisements);
        $advertisements->withPath(url()->full());
        $advertisements = customPagination($advertisements, 'ads');

        return $advertisements;
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
        $imageName = $this->uploadImageBase64($request->image, adPath(), $request->slug);

        Advertisement::create([
            'slug' => $request->slug,
            'position' => $request->position,
            'status' => $request->status,
            'image' => $imageName ?? '',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return new AdvertisementResource($advertisement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $imageName = $this->uploadImageBase64($request->image, adPath(), $advertisement->slug);

        $advertisement->update([
            'slug' => $request->slug,
            'position' => $request->position,
            'status' => $request->status,
            'image' => $imageName ?? $advertisement->image,
        ]);

        return new AdvertisementResource($advertisement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return true;
    }

    public function filter($advertisements)
    {
        if (request()->slug) {
            $advertisements->where('slug', 'like', "%" . request('slug') . "%");
        }

        if (isset(request()->position)) {
            $advertisements->where('position', request('position'));
        }

        if (isset(request()->status)) {
            $advertisements->where('status', request('status'));
        }

        return $advertisements;
    }
}
