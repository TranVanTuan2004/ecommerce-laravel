@extends('client.master')

@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Tin tức / Blog</h2>
        <div class="row">
            <form action="{{ route('blogs') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm theo tiêu đề..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Tìm</button>
                </div>
            </form>
            @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($blog->image)
                    <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary btn-sm">Xem thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $blogs->appends(['search' => request('search')])->links() }}

        </div>
    </div>
</section>
@endsection