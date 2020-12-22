<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Models\OrderAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Resources\Admin\Orders\OrderResource;
use App\Http\Resources\Admin\Orders\StatusResource;
use App\Http\Resources\Admin\Orders\ShowOrderResource;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends AdminController
{
    use FileTrait;

    public function index()
    {
        $orders = Order::with(['user', 'serviceProvider', 'address', 'serviceOrders'])->orderBy('created_at', 'desc');

        $orders = $this->filter($orders);
        $orders = $orders->paginate(config('kashf.pagination_per_page'));
        $orders = OrderResource::collection($orders);
        $orders->withPath(url()->full());
        $orders = customPagination($orders, 'orders');
        return $orders;
    }

    public function show(Order $order)
    {
        return new ShowOrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'service_provider_id' => $request->service_provider_id,
            'price_to_pay'  => $request->price_to_pay,
            'status'  => $request->status,
        ]);

        return new ShowOrderResource($order);
    }

    public function filter($orders)
    {

        if (isset(request()->uuid) && request()->uuid) {
            $orders->where('uuid', request('uuid'));
        }

        if (isset(request()->status)) {
            $orders->where('status', request('status'));
        }

        if (isset(request()->service_provider_id)) {
            $orders->where('service_provider_id', request('service_provider_id'));
        }

        if (isset(request()->area_id)) {
            $orders->where('area_id', request('area_id'));
        }

        if (isset(request()->user_id)) {
            $orders->where('user_id', request('user_id'));
        }


        if (isset(request()->service_provider_type_id) && request()->service_provider_type_id) {
            $orders->where('service_provider_type_id', request()->service_provider_type_id);
        }

        return $orders;
    }

    public function getOrderStatuses()
    {
        return collect(Order::statusCodes());

    }

    public function getAttachment(OrderAttachment $attachment)
    {
        $filePath = $this->getAttachmentPath($attachment);
        $fileName = $attachment->name;
        return  response()->streamDownload(
            function () use ($filePath, $fileName) {
                // Open output stream
                if ($file = fopen($filePath, 'rb')) {
                    while (!feof($file) and (connection_status() == 0)) {
                        print(fread($file, 1024 * 8));
                        flush();
                    }
                    fclose($file);
                }
            },
            200,
            [
                'Content-Type' => $attachment->mime,
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]
        );

        // return response()->file($this->getAttachmentPath($attachment));
    }
}
