@extends('layouts.main')

@section('title')
    Site List
@endsection

@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Site</li>
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
                                        <th>{{ __('common.Site Name') }}</th>
                                        <th>{{ __('common.Site Admin') }}</th>
                                        <th style="text-align: center" >{{ __('common.Sections') }}</th>
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
                                                <td>{{ $record->admin->name }}</td>
                                                <td style="text-align: center" ><a class="btn btn-primary text-white" href="{{ route('site_section.edit',['site_id'=>$record->id]) }}"> {{ $record->site_sections_count }} </a></td>
                                                <td>{{ $record->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    @if ($record->status == 1)
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('site.destroy', ['site' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" checked />
                                                    @else
                                                        <input type="checkbox"
                                                            onchange="changeStatus(this,'{{ route('site.destroy', ['site' => $record->id]) }}')"
                                                            class="js-switch-success-multicolor-on-off" />
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <a type='button' title="More Details"
                                                            href="{{ route('site.show', ['site' => $record->id]) }}"
                                                            class='btn btn-info  text-white'>
                                                            <i class='fa fa-eye'></i>
                                                        </a>
                                                        <a type='button' title="Edit"
                                                            href="{{ route('site.edit', ['site' => $record->id]) }}"
                                                            class='btn btn-warning  text-white'>
                                                            <i class='fa fa-edit'></i>
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">
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
