@extends('layouts.main')

@section('title')
    Reports
@endsection

@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
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
                                        <th>{{ __('common.Date') }}</th>
                                        <th>{{ __('common.Site') }}</th>
                                        <th>{{ __('common.Rating') }}</th>
                                        <th>{{ __('common.Created By') }}</th>
                                        <th>{{ __('common.Created At') }}</th>
                                        <th class="text-center">{{ __('common.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($records) && count($records) > 0)
                                        @foreach ($records as $record)
                                            <tr>
                                                <td>{{ $record->date }}</td>
                                                <td>{{ $record->site->name }}</td>
                                                <td>{{ $record->sum_rating }}  / {{config('common.rating__by')}} </td>
                                                <td>{{ $record->user->name }}</td>
                                                <td>{{ $record->created_at->format('Y-m-d H:i:s') }}</td>

                                                <td class="text-center">
                                                    <p>

                                                        @canany(['report_create', 'report_edit'])
                                                            <a type='button' title="Edit Report"
                                                                href="{{ route('report.edit', ['report' => $record->id]) }}"
                                                                class='btn btn-warning  text-white'>
                                                                <i class='fa fa-edit'></i>
                                                            </a>
                                                        @endcanany
                                                        @canany(['report_create', 'report_edit', 'report_delete',
                                                            'report_view'])
                                                            <a type='button' title="More Details"
                                                                href="{{ route('report.show', ['report' => $record->id]) }}"
                                                                class='btn btn-info  text-white'>
                                                                <i class='fa fa-eye'></i>
                                                            </a>
                                                        @endcanany

                                                        <a type='button' target="_blank" title="Print"
                                                            href="{{ route('report.print', ['report_id' => $record->id]) }}"
                                                            class=php 'btn btn-primary  text-white'>
                                                            <i class='fa fa-print'></i>
                                                        </a>
                                                        @canany(['comment_add'])
                                                            <a type='button' title="Add Comment"
                                                                href="{{ route('report_comment.create', ['report_id' => $record->id]) }}"
                                                                class='btn btn-warning text-white'>
                                                                <i class='fa fa-comment'></i>
                                                            </a>
                                                        @endcanany
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">
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
