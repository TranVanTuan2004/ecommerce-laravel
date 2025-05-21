<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element" style="display: flex; align-items: center; gap: 10px"> <span>
                        <img alt="image" class="img-circle" style="width: 50px; height: 50px; object-fit: cover;"
                            src="https://naidecor.vn/wp-content/uploads/2023/09/landscape_photography_tips_featured_image_1024x1024.webp" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                                    Williams</strong>
                            </span>
                </div>
            </li>

            <li>
                <a href={{ route('dashboard') }}>
                    <i class="fa fa-th-large"></i> <span class="nav-label">Trang Chủ</span>
                </a>
            </li>

            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        User</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href={{ route('users.index') }}>Quản lý User</a></li>
                </ul>
            </li>


            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        Brand</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="active"><a href={{ route('brand.index') }}>Quản Lý Brand</a></li>

                </ul>
            </li>
            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        Blog</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('blog.index') }}">Quản Lý Blog</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        Voucher</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href={{ route('voucher.index') }}>Quản lý Voucher</a></li>
                </ul>
            </li>

            <li>
                <a href={{ route('topusers.show') }}><i class="fa fa-th-large"></i> <span class="nav-label">Top 10
                        Users</span>
                    <span class="fa arrow"></span>
                </a>
            </li>

            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        Danh Mục</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href={{ route('category.index') }}>Quản lý Danh Mục</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lý
                        Đơn Hàng</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href={{ route('oder.index') }}>Quản lý Đơn Hàng</a></li>
                </ul>
            </li>

        </ul>

    </div>
</nav>
