<?php

namespace App\Http\Controllers\Admin;

use App\Models\Examination;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Examinations\ExaminationResource;
use App\Http\Resources\Admin\Examinations\ShowExaminationResource;

class ExaminationController extends Controller
{
    use FileTrait;

    public function index()
    {
        $exminations = Examination::orderDisplay();
        $exminations = $this->filter($exminations)->paginate(config('kashf.paginate_per_page'));
        $exminations->withPath(url()->full());
        $exminations = ExaminationResource::collection($exminations);
        return customPagination($exminations);
    }

    public function getAll()
    {
        return Examination::get(['id', 'title']);
    }

    public function show(Examination $examination)
    {
        return new ShowExaminationResource($examination);
    }

    public function store(Request $request)
    {
        $iconName = $this->uploadImageBase64($request->icon, iconPath(), $request->slug);

        $examination = Examination::create([
            'title' => $request->title,
            'description' => $request->description,
            'display_order' => $request->display_order,
            'icon' => $iconName,
            'slug' => $request->slug,
            'status' => $request->status,
            'accept_multi' => $request->accept_multi,
        ]);

        return new ShowExaminationResource($examination);
    }

    public function update(Request $request, Examination $examination)
    {
        $iconName = $this->uploadImageBase64($request->icon, iconPath(), $examination->slug);

        $examination->update([
            'title' => $request->title,
            'description' => $request->description,
            'display_order' => $request->display_order,
            'icon' => $iconName ?? $examination->icon,
            'slug' => $request->slug,
            'status' => $request->status,
            'accept_multi' => $request->accept_multi,
        ]);

        return new ShowExaminationResource($examination);
    }

    public function destroy(Examination $examination)
    {
        $examination->delete();
        return true;

    }

    public function filter($examinations)
    {
        if (request('title')) {
            $examinations->where('title', "like", "%" . request('title') . "%");
        }

        if (isset(request()->status)) {
            $examinations->where('status', request('status'));
        }

        return $examinations;
    }
}
