<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2></h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Branch</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row mt-20 mb-20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div style="display: flex; justify-content: space-between">
                    <a href={{ route('brand.create') }} class="btn btn-primary d-block">Thêm Brand</a>
                    <div class="input-group">
                        <input type="text" class="form-control" style="display: block; width: 300px;"
                            placeholder="Tìm kiếm">
                    </div>
                </div>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    @if (isset($brands) && is_object($brands))
                        @foreach ($brands as $brand)
                            <tbody class="">
                                <tr>
                                    <td>
                                        <input type="checkbox" value="" id="checkAll"
                                            class="input-checkbox checkBoxItem">
                                    </td>
                                    <td>
                                        {{ $brand->name }}
                                    </td>
                                    <td>
                                        <img src={{ asset('storage/' . $brand->logo) }}
                                            style="width:100px; height:100px; object-fit: cover; border-radius: 6px"
                                            alt="Not found">
                                    </td>
                                    <td>
                                        {{ $brand->description }}
                                    </td>
                                    <td>
                                        {{ $brand->status }}
                                    </td>
                                    <td
                                        style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                        <a href={{ route('brand.edit', $brand->id) }} class="btn btn-primary"><i
                                                class="fa fa-edit"></i></a>
                                        <form action="{{ route('brand.destroy', $brand->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa không')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif
                </table>
                {{ $brands->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
