@extends('layouts.admin')

@section('title', 'Settings - ' . config('app.name'))

@section('page-title', 'Platform Settings')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="site_name" class="form-label">Site Name *</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                   id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required>
                            @error('site_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Contact Email *</label>
                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                   id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" required>
                            @error('contact_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                   id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}">
                            @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2">{{ old('address', $settings['address']) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Recommended: PNG or JPG, max 2MB</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="about_us" class="form-label">About Us</label>
                            <textarea class="form-control @error('about_us') is-invalid @enderror" 
                                      id="about_us" name="about_us" rows="4">{{ old('about_us', $settings['about_us'] ?? '') }}</textarea>
                            @error('about_us')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="privacy_policy" class="form-label">Privacy Policy</label>
                            <textarea class="form-control @error('privacy_policy') is-invalid @enderror" 
                                      id="privacy_policy" name="privacy_policy" rows="4">{{ old('privacy_policy', $settings['privacy_policy'] ?? '') }}</textarea>
                            @error('privacy_policy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="terms_conditions" class="form-label">Terms & Conditions</label>
                            <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                      id="terms_conditions" name="terms_conditions" rows="4">{{ old('terms_conditions', $settings['terms_conditions'] ?? '') }}</textarea>
                            @error('terms_conditions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- System Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">System Information</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>PHP Version</span>
                        <strong>{{ PHP_VERSION }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Laravel Version</span>
                        <strong>{{ app()->version() }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Server</span>
                        <strong>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Database</span>
                        <strong>{{ config('database.default') }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Timezone</span>
                        <strong>{{ config('app.timezone') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h6 class="m-0 font-weight-bold">Danger Zone</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> These actions are irreversible.
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clearCacheModal">
                        <i class="fas fa-broom me-2"></i>Clear Cache
                    </button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clearDataModal">
                        <i class="fas fa-trash me-2"></i>Clear Old Data
                    </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetStatsModal">
                        <i class="fas fa-redo me-2"></i>Reset Statistics
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Clear Cache Modal -->
<div class="modal fade" id="clearCacheModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Clear Cache</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to clear all application cache?</p>
                <p class="text-warning">This will refresh cached configurations and views.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Clear Cache</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Clear Data Modal -->
<div class="modal fade" id="clearDataModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Clear Old Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete all expired jobs and applications older than 6 months?</p>
                <p class="text-danger"><strong>This action cannot be undone!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.settings.clear-data') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete Old Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reset Stats Modal -->
<div class="modal fade" id="resetStatsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset all platform statistics?</p>
                <p class="text-danger"><strong>This action cannot be undone!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.settings.reset-stats') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reset Statistics</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection