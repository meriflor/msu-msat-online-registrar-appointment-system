@extends('admin-dashboard.admin')

@section('content')
<div class="d-flex flex-row align-items-center mb-3">
        <a class="btn btn-custom d-flex flex-row align-items-center" href="/dashboard-admin/dashboard">
            <img src="/images/back-arrow.png" class="me-3"
            style=" height: 10px;
                    width: 10px;"/>
            Home
        </a>
    </div>
    <nav class="navigation this-box mb-3">
        <ul class="font-nun small-nav">
            <!-- //fix -->
            <li><a href="#pending">Pending Registrations</a></li>
            <li><a href="#approved">Approved Registrations</a></li>
            <li><a href="#rejected">Rejected Registrations</a></li>
        </ul>
    </nav>
    <!-- fix id of the section -->
    <div class="row d-flex flex-row m-2" id="pending">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Pending Registrations</div>
            @if(count($pending)>0)
            <div class="table-rounded">
                <table id="pendingUsers" class="table font-nun hover display compact cell-border nowrap table-condensed" style="width:100%">
                    <thead class="table-head">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Course</th>
                            <th>Academic Year</th>
                            <th>Year Graduated</th>
                            <th class="right">Action</th>
                            <th>Cellphone Number: </th>
                            <th>Email: </th>
                            <th>Gender: </th>
                            <th>Address: </th>
                            <th>Civil Status: </th>
                            <th>Birthdate: </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($pending as $user)
                            <tr class="text-start">
                                <td>{{ $user->school_id }}</td>
                                <td>{{ $user->lastName . ', ' . $user->firstName . ' ' . $user->middleName . ' ' . $user->suffix}}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->course }}</td>
                                @if($user->acadYear == null || $user->acadYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->acadYear }}</td>
                                @endif
                                @if($user->gradYear == null || $user->gradYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->gradYear }}</td>
                                @endif
                                <td class="td-view">
                                    <div class="dropdown">
                                        <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e;">
                                            <li><a class="dropdown-item active" type="button" href="{{ route('user-approve', $user->id) }}">Approve</a></li>
                                            <li><a class="dropdown-item" type="button" href="{{ route('user-reject', $user->id) }}">Reject</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $user->cell_no }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->civil_status }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="text-center">We haven't received any new user yet.</div>
            @endif
        </div>
    </div>

    <div class="row d-flex flex-row m-2 mt-3" id="approved">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Approved Registrations</div>
            @if(count($approved)>0)
            <div class="table-rounded">
                <table id="approvedUsers" class="table font-nun hover display compact cell-border nowrap" style="width:100%">
                    <thead class="table-head">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Course</th>
                            <th>Academic Year</th>
                            <th>Year Graduated</th>
                            <th class="right">Action</th>
                            <th>Cellphone Number: </th>
                            <th>Email: </th>
                            <th>Gender: </th>
                            <th>Address: </th>
                            <th>Civil Status: </th>
                            <th>Birthdate: </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($approved as $user)
                            <tr class="text-start">
                                <td>{{ $user->school_id }}</td>
                                <td>{{ $user->lastName . ', ' . $user->firstName . ' ' . $user->middleName . ' ' . $user->suffix}}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->course }}</td>
                                @if($user->acadYear == null || $user->acadYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->acadYear }}</td>
                                @endif
                                @if($user->gradYear == null || $user->gradYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->gradYear }}</td>
                                @endif
                                <td class="td-view">
                                    <div class="dropdown d-flex flex-column justify-contents-center">
                                        <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e;">
                                            <li><a class="dropdown-item active" type="button" href="{{ route('user-pending', $user->id) }}">Pending</a></li>
                                            <li><a class="dropdown-item" type="button" href="{{ route('user-reject', $user->id) }}">Reject</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $user->cell_no }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->civil_status }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="text-center">We haven't received any new user yet.</div>
            @endif
        </div>
    </div>

    <div class="row d-flex flex-row m-2 mt-3" id="rejected">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Rejected Registrations</div>
            @if(count($rejected)>0)
            <div class="table-rounded">
                <table id="rejectedUsers" class="table font-nun hover display compact cell-border nowrap" style="width:100%">
                    <thead class="table-head">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Course</th>
                            <th>Academic Year</th>
                            <th>Year Graduated</th>
                            <th class="right">Action</th>
                            <th>Cellphone Number: </th>
                            <th>Email: </th>
                            <th>Gender: </th>
                            <th>Address: </th>
                            <th>Civil Status: </th>
                            <th>Birthdate: </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($rejected as $user)
                            <tr class="text-start">
                                <td>{{ $user->school_id }}</td>
                                <td>{{ $user->lastName . ', ' . $user->firstName . ' ' . $user->middleName . ' ' . $user->suffix}}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->course }}</td>
                                @if($user->acadYear == null || $user->acadYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->acadYear }}</td>
                                @endif
                                @if($user->gradYear == null || $user->gradYear == "")
                                    <td>N/A</td>
                                @else
                                    <td>{{ $user->gradYear }}</td>
                                @endif
                                <td class="td-view">
                                    <div class="dropdown d-flex flex-column justify-contents-center">
                                        <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e;">
                                            <li><a class="dropdown-item active" type="button" href="{{ route('user-pending', $user->id) }}">Pending</a></li>
                                            <li><a class="dropdown-item" type="button" href="{{ route('user-approve', $user->id) }}">Approve</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $user->cell_no }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->civil_status }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="text-center">We haven't received any new user yet.</div>
            @endif
        </div>
    </div>

    
    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
@endsection