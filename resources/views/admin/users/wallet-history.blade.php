<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group">
            <label for="wallet_amount">{{ __('messages.wallet_amount') }}</label>
            <input type="text" id="wallet_amount" class="form-control validationFloat"
                value="{{ old('wallet_amount') }}" name="wallet_amount"
                placeholder="{{ __('messages.wallet_amount') }}">
            <input type="hidden" id="wallet_id" class="form-control"
                value="{{ old('wallet_id', !empty($wallet->id) ? $wallet->id : 0) }}" name="wallet_id">
            <input type="hidden" id="user_wallet_id" class="form-control" value="{{ old('user_wallet_id', $id) }}"
                name="user_wallet_id">
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="form-group">
            <button type="button" class="btn btn-primary mt-2" id="save"
                onclick="walletUpdate();">{{ __('messages.add') }}</button>
        </div>
    </div>
    <div class="col-12 col-sm-3 ">
        <div class="form-group mt-2">
            <label for="wallet_amount">{{ __('messages.wallet_amount') }} : </label>
            <span class="text-bold-600" id="text-amount"
                >{{ !empty($wallet->amount) ? $wallet->amount : 0 }}</button>
        </div>
    </div>
</div>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('messages.wallet_histories') }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table wallet-histories">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.date') }}</th>
                                        <th>{{ __('messages.amount') }}</th>
                                        <th> {{ __('messages.type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($walletHistories as $walletHistory)
                                        <tr>
                                            <td>
                                                {{ date('d-m-Y', strtotime($walletHistory->created_at)) }}
                                            </td>
                                            <td>
                                                ₹{{ $walletHistory->amount }}
                                            </td>
                                            <td>
                                                {{ $walletHistory->type }}
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
</section>
