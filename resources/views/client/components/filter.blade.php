<form method="GET" action="{{ route('product.shop') }}">
    <div class="container my-4">
        <div class="row align-items-center">
            <!-- SORTING -->
            <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
                <div class="dropdown me-3">
                    <select class="form-select" name="sort_by" onchange="this.form.submit()">
                        <option value="">-- Sắp xếp --</option>
                        <option value="popular" {{ request('sort_by') == 'popular' ? 'selected' : '' }}>Phổ biến</option>
                        <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    </select>
                </div>

                <!-- VIEW TOGGLE (không cần submit) -->
                <div class="view-toggle">
                    <button type="button" class="btn btn-sm btn-outline-secondary active me-2">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

            <!-- PER PAGE -->
            <div class="col-md-6 text-md-end">
                <div class="items-per-page">
                    <span class="me-2">Hiển thị</span>
                    <select class="form-select form-select-sm d-inline-block w-auto" name="per_page" onchange="this.form.submit()">
                        <option value="8" {{ request('per_page') == '8' ? 'selected' : '' }}>8</option>
                        <option value="16" {{ request('per_page') == '16' ? 'selected' : '' }}>16</option>
                        <option value="24" {{ request('per_page') == '24' ? 'selected' : '' }}>24</option>
                        <option value="32" {{ request('per_page') == '32' ? 'selected' : '' }}>32</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>