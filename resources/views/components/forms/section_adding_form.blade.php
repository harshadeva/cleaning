<div class="card-body">
    <div class="col-md-12">
        <h4>{{ __('common.' . $header) }}</h4>
        <hr />
    </div>
    <div class="col-md-12">
        <div data-group="test" class="row items">
            @csrf
            <div class="col-lg-10 item-content">
                <div class="form-group">
                    <label for="">Label</label>
                    <input type="text" value="1" class="form-control" name="sections[]" id="id">
                </div>
            </div>
            <div class="col-lg-2 pull-right repeater-remove-btn mt-4">
                <button style="margin-top: 5px" id="remove-btn" class="btn btn-danger"
                    onclick="$(this).parents('.items').remove()">
                    Remove
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="repeater-heading">
                    <button type="button" class="btn btn-primary repeater-add-btn">
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
