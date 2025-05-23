@extends('client.master')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">{{ $blog->title }}</h2>
        @if ($blog->image)
        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid mb-4">
        @endif
        <div>{!! $blog->content !!}</div>
        <a href="{{ route('blogs') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
    </div>
</section>
@endsection