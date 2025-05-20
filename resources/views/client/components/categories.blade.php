<style>
    .dropdown-menu {
        max-height: 400px;
        overflow-y: auto;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        font-size: 16px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Màu nền khi hover */
    .dropdown-item:hover {
        background-color: #007bff;
        /* Màu nền khi hover */
        color: #fff;
        /* Màu chữ khi hover */
    }

    .category-name {
        font-weight: 500;
        color: #333;
    }

    .badge {
        font-size: 12px;
    }

    /* .dropdown-toggle::after {
        display: none;
        
    } */
</style>
<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
            <!-- Categories Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Danh mục sản phẩm
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('product.shop') }}" class="dropdown-item">
                            <span class="category-name">Tất cả</span>
                        </a>
                    </li>
                    @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('product.shop', ['category_id' => $category->id]) }}"
                            class="dropdown-item d-flex justify-content-between align-items-center {{ request('category_id') == $category->id ? 'active text-white bg-primary' : '' }}">
                            <span class="category-name">{{ $category->name }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $category->products_count ?? 0 }} sản phẩm</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>