<div class="data-fields px-2 mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('messages.order_details') }}</h4>
                </div>
                <div class="card-content" style="overflow: auto; max-height:85vh">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table order-details">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.image') }}</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.quantity') }}</th>
                                        <th>{{ __('messages.price') }}</th>
                                        <th> {{ __('messages.total_price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $orderItem)
                                        <tr>
                                            <td class="product-img">
                                                <img src="{{ !empty($orderItem->product->images[0]->image_url) ? $orderItem->product->images[0]->image_url : '' }}"
                                                    class="w-50" height="120px" alt="Img placeholder">
                                            </td>
                                            <td>
                                                {{ !empty($orderItem->product) ? $orderItem->product->title : '' }}
                                                <div class="badge badge-pill badge-primary">
                                                    {{ !empty($orderItem->product) ? $orderItem->product->unit_number : '' }}
                                                    {{ !empty($orderItem->unit) ? $orderItem->unit->title : '' }}</div>
                                            </td>
                                            <td>
                                                {{ $orderItem->quantity }}
                                            </td>
                                            <td>
                                                ₹ {{ $orderItem->price }}
                                            </td>
                                            <td>
                                                ₹ {{ $orderItem->item_total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
