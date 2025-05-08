<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
            <!-- Sorting Dropdown -->
            <div class="dropdown me-3">
                <select class="form-select" name="sorting" id="shop-sorting">
                    <option value="default">Default sorting</option>
                    <option value="popularity">Sort by popularity</option>
                    <option value="rating">Sort by rating</option>
                    <option value="date">Sort by latest</option>
                    <option value="price-asc">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select>
            </div>

            <!-- View Toggle -->
            <div class="view-toggle">
                <button class="btn btn-sm btn-outline-secondary active me-2">
                    <i class="fas fa-th"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <!-- Items Per Page -->
            <div class="items-per-page">
                <span class="me-2">Show</span>
                <select class="form-select form-select-sm d-inline-block w-auto" name="per-page" id="shop-per-page">
                    <option value="8">8</option>
                    <option value="16">16</option>
                    <option value="24">24</option>
                    <option value="32">32</option>
                </select>
            </div>
        </div>
    </div>
</div>
