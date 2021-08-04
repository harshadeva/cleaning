@extends('layouts.main')
@section('title')
    Users
@endsection

@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </div>
@endsection

@section('style')
@endsection
@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="display table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.Name') }}</th>
                                        <th>{{ __('common.Company') }}</th>
                                        <th>{{ __('common.User Role') }}</th>
                                        <th>{{ __('common.Created At') }}</th>
                                        <th>{{ __('common.Status') }}</th>
                                        <th style="text-align: center">{{ __('common.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($records))
                                        @foreach ($records as $record)
                                            <tr>
                                                <td>{{ $record->name }}</td>
                                                <td>{{ $record->getCompany()->name }}</td>
                                                <td>{{ ucwords($record->getRoleNames()->first()) }}</td>
                                                <td>{{ $record->created_at }}</td>
                                                <td>
                                                    @if ($record->status == 1)
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('admin.user.destroy', ['user' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" checked />
                                                    @else
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('admin.user.destroy', ['user' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" />
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <p>
                                                        @if ($record->hasRole('company admin'))
                                                            <a type='button' title="View Company Details"
                                                                href="{{ route('admin.company.show', ['company' => $record->companyAdminAccount()->company_id]) }}"
                                                                class='btn btn-info'>
                                                                <i class='fa fa-eye'></i>
                                                            </a>
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')

    <script>
        function changeStatus(element, url) {
            $(element).attr('disabled', true);

            $.ajax({
                url: url,
                type: 'DELETE',
                success: function(data) {
                    if (data.success) {
                        showSuccess(data.success);
                    } else {
                        showError('Something went wrong!');
                    }
                }
            });

        }
    </script>
@endsection
