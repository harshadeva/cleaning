<div class="row">
    <div class="card-body">
        <div class="card-body">
            <div class="col-md-12">
                <h4>{{ __('common.' . $header) }}</h4>
                <hr />
            </div>
            <div class="col-md-12">
                <div id="repeater">
                    <div align="right">
                        <button type="button" id="reapeater-add-btn" class="btn btn-primary repeater-add-btn"><span
                                class="fa fa-plus"></span>
                            Section</button>
                    </div>
                    <div class="clearfix"></div>
                    @if (isset($record) && $record->siteSections != null)
                        @foreach ($record->siteSections as $siteSection)
                            <div class="items" data-group="sections">
                                <div class="item-content">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label>Select Section</label>
                                                <select class="form-control" data-skip-name="true"
                                                    data-name="sections[]" required>
                                                    <option disabled selected value="">Select Section</option>
                                                    @foreach ($sections as $section)
                                                        <option @php
                                                            if ($siteSection->section_id == $section->id) {
                                                                echo 'selected';
                                                            }
                                                        @endphp @endphp value="{{ $section->id }}">
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 d-flex justify-content-start" style="margin-top:24px;" align="end">
                                                <button id="remove-btn" class="btn btn-danger"
                                                    onclick="$(this).parents('.items').remove()">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="items" data-group="sections">
                            <div class="item-content">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label>Select Section</label>
                                            <select class="form-control" data-skip-name="true" data-name="sections[]"
                                                required>
                                                <option disabled selected value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-start" style="margin-top:24px;" align="end">
                                            <button id="remove-btn" class="btn btn-danger"
                                                onclick="$(this).parents('.items').remove()">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
