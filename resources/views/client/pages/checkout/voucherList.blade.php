@foreach ($vouchers as $voucher)
    <div class="border p-2 mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $voucher->name }}</strong><br>
                <small>Giảm {{ number_format($voucher->discount, 0) }}%</small>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary select-voucher" data-code="{{ $voucher->code }}"
                data-name="{{ $voucher->name }}" data-percent="{{ $voucher->discount }}">
                Chọn
            </button>
        </div>
    </div>
@endforeach
