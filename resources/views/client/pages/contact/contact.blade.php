@extends('client.master')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-4">Liên hệ với chúng tôi</h1>

    <div class="mb-6">
        <p><strong>Địa chỉ:</strong> 53 Đường Võ Văn Ngân, Quận Thủ Đức, TP.HCM</p>
        <p><strong>Số điện thoại:</strong> 0909 999 999</p>
        <p><strong>Email:</strong> shopcuatoi@example.com</p>
        <p><strong>Giờ làm việc:</strong> 8:00 - 20:00 (T2 - CN)</p>
    </div>

    <div class="mb-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.474909851613!2d106.75548917420699!3d10.851437757807325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1748494379794!5m2!1svi!2s" width="100%"
            height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <form method="POST" action="{{ route('contact.send') }}" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên của bạn</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại (không bắt buộc)</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Nội dung</label>
            <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Gửi</button>
    </form>


    @if(session('success'))
    <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif
</div>
@endsection