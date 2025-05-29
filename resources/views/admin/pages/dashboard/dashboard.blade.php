@extends('admin.master')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <a href={{ route('product.top10') }} class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Tất cả</span>
                        <h5>Top 10 sản phẩm bán chạy nhất</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalSoldProducts }}</h1>
                        <div class="stat-percent font-bold text-success">100%<i class="fa fa-bolt"></i></div>
                        <small>Đã bán</small>
                    </div>
                </div>
            </a>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Annual</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">275,800</h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5>visits</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">106,120</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>New visits</small>
                    </div>
                </div>
            </div>
            <a href={{ route('topusers.show') }}>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">Low value</span>
                            <h5>Top 10 Users</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">36,000</h1>
                            <div class="stat-percent font-bold text-danger">36% <i class="fa fa-level-down"></i>
                            </div>
                            <small>In first month</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Orders</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">Today</button>
                                <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                <button type="button" class="btn btn-xs btn-white">Annual</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <ul class="stat-list">
                                    <li>
                                        <h2 class="no-margins">2,346</h2>
                                        <small>Total orders in period</small>
                                        <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 48%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">4,422</h2>
                                        <small>Orders in last month</small>
                                        <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">9,180</h2>
                                        <small>Monthly income from orders</small>
                                        <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 22%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Messages</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                        <small>
                            <i class="fa fa-tim"></i> You have {{ $totalMessages }} total messages in the system.
                        </small>
                    </div>
                    <div class="ibox-content">
                        <div class="feed-activity-list">
                            @foreach ($recentMessages as $message)
                                <div class="feed-element">
                                    <div>
                                        <small
                                            class="pull-right text-navy">{{ $message->created_at->diffForHumans() }}</small>
                                        <strong>
                                            {{-- Nếu bạn muốn hiển thị tên user gửi, bạn cần quan hệ User trong model Message --}}
                                            {{ $message->sender === 'admin' ? 'Admin' : $message->user->name ?? 'User #' . $message->user_id }}
                                        </strong>
                                        <div>{{ Str::limit($message->content, 80) }}</div>
                                        <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>User project list</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><small>Pending...</small></td>
                                            <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                            <td>Samantha</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-warning">Canceled</span> </td>
                                            <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                            <td>Monica</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                        </tr>
                                        <tr>
                                            <td><small>Pending...</small> </td>
                                            <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                            <td>John</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                        </tr>
                                        <tr>
                                            <td><small>Pending...</small> </td>
                                            <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                            <td>Agnes</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                        </tr>
                                        <tr>
                                            <td><small>Pending...</small> </td>
                                            <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                            <td>Janet</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-primary">Completed</span> </td>
                                            <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                            <td>Amelia</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                        </tr>
                                        <tr>
                                            <td><small>Pending...</small> </td>
                                            <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                            <td>Damian</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Small todo list</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <ul class="todo-list m-t small-list">
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                        <span class="m-l-xs todo-completed">Buy a milk</span>

                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-square-o"></i>
                                        </a>
                                        <span class="m-l-xs">Go to shop and find some products.</span>

                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-square-o"></i>
                                        </a>
                                        <span class="m-l-xs">Send documents to Mike</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1
                                            mins</small>
                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-square-o"></i>
                                        </a>
                                        <span class="m-l-xs">Go to the doctor dr Smith</span>
                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                        <span class="m-l-xs todo-completed">Plan vacation</span>
                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-square-o"></i>
                                        </a>
                                        <span class="m-l-xs">Create new stuff</span>
                                    </li>
                                    <li>
                                        <a href="#" class="check-link"><i class="fa fa-square-o"></i>
                                        </a>
                                        <span class="m-l-xs">Call to Anna for dinner</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Transactions worldwide</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-hover margin bottom">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%" class="text-center">No.</th>
                                                    <th>Transaction</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td> Security doors
                                                    </td>
                                                    <td class="text-center small">16 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$483.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td> Wardrobes
                                                    </td>
                                                    <td class="text-center small">10 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$327.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td> Set of tools
                                                    </td>
                                                    <td class="text-center small">12 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-warning">$125.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td> Panoramic pictures</td>
                                                    <td class="text-center small">22 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$344.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>Phones</td>
                                                    <td class="text-center small">24 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$235.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">6</td>
                                                    <td>Monitors</td>
                                                    <td class="text-center small">26 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$100.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="world-map" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
