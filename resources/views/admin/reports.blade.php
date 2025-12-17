@extends('layouts.admin')

@section('title', 'Reports - ' . config('app.name'))

@section('page-title', 'Reports & Analytics')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Platform Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($stats as $key => $value)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card stat-card {{ 
                            $key == 'total_users' ? 'primary' : 
                            ($key == 'total_jobs' ? 'success' : 
                            ($key == 'total_applications' ? 'info' : 
                            ($key == 'total_hires' ? 'warning' : 'danger'))) 
                        }}">
                            <div class="card-body">
                                <div class="stat-title">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                <div class="stat-value">{{ $value }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Monthly Jobs Chart -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Monthly Job Postings</h6>
            </div>
            <div class="card-body">
                <canvas id="monthlyJobsChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Job Categories -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Top Job Categories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Jobs</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalJobs = $categories->sum('count');
                            @endphp
                            @foreach($categories as $category)
                                @php
                                    $percentage = $totalJobs > 0 ? round(($category->count / $totalJobs) * 100, 1) : 0;
                                @endphp
                                <tr>
                                    <td>{{ $category->category }}</td>
                                    <td>{{ $category->count }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                 style="width: {{ $percentage }}%">
                                                {{ $percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Application Status -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Application Status Distribution</h6>
            </div>
            <div class="card-body">
                <canvas id="applicationStatusChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- User Distribution -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">User Distribution by Role</h6>
            </div>
            <div class="card-body">
                <canvas id="userRoleChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Jobs Chart
        const monthlyJobsCtx = document.getElementById('monthlyJobsChart').getContext('2d');
        
        // Prepare data in PHP and pass to JavaScript
        const monthlyLabels = @json($monthlyJobs->map(function($item) {
            $date = new DateTime($item->month . '-01');
            return $date->format('M Y');
        })->toArray());
        
        const monthlyData = @json($monthlyJobs->pluck('count')->toArray());

        const monthlyJobsChartData = {
            labels: monthlyLabels,
            datasets: [{
                label: 'Jobs Posted',
                data: monthlyData,
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        };

        new Chart(monthlyJobsCtx, {
            type: 'line',
            data: monthlyJobsChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Application Status Chart
        const applicationStatusCtx = document.getElementById('applicationStatusChart').getContext('2d');
        const applicationStatusData = {
            labels: ['Pending', 'Reviewed', 'Shortlisted', 'Hired', 'Rejected'],
            datasets: [{
                data: [
                    {{ \App\Models\JobApplication::where('status', 'pending')->count() }},
                    {{ \App\Models\JobApplication::where('status', 'reviewed')->count() }},
                    {{ \App\Models\JobApplication::where('status', 'shortlisted')->count() }},
                    {{ \App\Models\JobApplication::where('status', 'hired')->count() }},
                    {{ \App\Models\JobApplication::where('status', 'rejected')->count() }}
                ],
                backgroundColor: [
                    'rgba(246, 194, 62, 0.8)',
                    'rgba(54, 185, 204, 0.8)',
                    'rgba(78, 115, 223, 0.8)',
                    'rgba(28, 200, 138, 0.8)',
                    'rgba(231, 74, 59, 0.8)'
                ],
                borderColor: [
                    'rgba(246, 194, 62, 1)',
                    'rgba(54, 185, 204, 1)',
                    'rgba(78, 115, 223, 1)',
                    'rgba(28, 200, 138, 1)',
                    'rgba(231, 74, 59, 1)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(applicationStatusCtx, {
            type: 'doughnut',
            data: applicationStatusData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // User Role Distribution Chart
        const userRoleCtx = document.getElementById('userRoleChart').getContext('2d');
        const userRoleData = {
            labels: ['Admins', 'Employers', 'Job Seekers'],
            datasets: [{
                data: [
                    {{ \App\Models\User::where('role', 'admin')->count() }},
                    {{ \App\Models\User::where('role', 'employer')->count() }},
                    {{ \App\Models\User::where('role', 'job_seeker')->count() }}
                ],
                backgroundColor: [
                    'rgba(231, 74, 59, 0.8)',
                    'rgba(78, 115, 223, 0.8)',
                    'rgba(28, 200, 138, 0.8)'
                ],
                borderColor: [
                    'rgba(231, 74, 59, 1)',
                    'rgba(78, 115, 223, 1)',
                    'rgba(28, 200, 138, 1)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(userRoleCtx, {
            type: 'pie',
            data: userRoleData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush