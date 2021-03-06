@extends('layouts.main')

@section('title')
    Company List
@endsection

@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Company</li>
        </ol>
    </div>
@endsection

@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">

                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="display table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.Company Name') }}</th>
                                        <th>{{ __('common.Company Admin') }}</th>
                                        <th style="text-align: center">{{ __('common.Sites') }}</th>
                                        <th style="text-align: center">{{ __('common.Employees') }}</th>
                                        <th>{{ __('common.Created At') }}</th>
                                        <th>{{ __('common.Status') }}</th>
                                        <th class="text-center">{{ __('common.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($records) && count($records) > 0)
                                        @foreach ($records as $record)
                                            <tr>
                                                <td>{{ $record->name }}</td>
                                                <td>{{ $record->admin()->user->name }}</td>
                                                <td style="text-align: center" >{{ $record->sites()->active()->count() }}</td>
                                                <td style="text-align: center" >{{ $record->employees()->active()->count() }}</td>
                                                <td>{{ $record->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    @if ($record->status == 1)
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('admin.company.destroy', ['company' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" checked />
                                                    @else
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('admin.company.destroy', ['company' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" />
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <a type='button' title="More Details"
                                                            href="{{ route('admin.company.show', ['company' => $record->id]) }}"
                                                            class='btn btn-info'>
                                                            <i class='fa fa-eye'></i>
                                                        </a>
                                                        <a type='button' title="Edit"
                                                            href="{{ route('admin.company.edit', ['company' => $record->id]) }}"
                                                            class='btn btn-warning'>
                                                            <i class='fa fa-edit'></i>
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                No records to display!
                                            </td>
                                        </tr>

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
