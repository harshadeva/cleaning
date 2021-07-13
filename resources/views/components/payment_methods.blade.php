<div id="chequeDiv" style="display: none" class="card m-b-30">
    <div class="card-body">
        <h5 class="card-title">{{ __('common.Cheque Details') }}</h5>

        <div class="row">
            <div class="col-lg-4">
                <label for="cheque_number">{{ __('common.Cheque Number') }}</label>
                <div class="form-group">
                    <input type="number"
                        value="{{ isset($record->cheque) ? $record->cheque->cheque_number : old('cheque_number') }}"
                        class="form-control chequeDetails" name="cheque_number" id="cheque_number" placeholder="0.00">
                </div>
            </div>

            <div class="col-lg-4">
                <label for="cheque_date">{{ __('common.Cheque Date') }}</label>
                <div class="input-group">
                    <input type="text" id="cheque_date" name="cheque_date" autocomplete="off"
                        class="autoclose-date chequeDetails datepicker-here form-control" placeholder="yyyy/mm/dd"
                        aria-describedby="basic-addon3" />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon3"><i class="feather icon-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <label for="branch_code">{{ __('common.Branch Code') }}</label>
                <div class="form-group">
                    <input type="text"
                        value="{{ isset($record->cheque) ? $record->cheque->branch_number : old('branch_code') }}"
                        class="form-control chequeDetails" name="branch_code" id="branch_code"
                        placeholder="Branch Code">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="bankDiv" style="display: none" class="card m-b-30">
    <div class="card-body">
        <h5 class="card-title">{{ __('common.Bank Details') }}</h5>

        <div class="row">
             <div class="col-lg-4 form-group">
                <label for="bank_account">{{ __('common.Bank Account') }}</label>
                <select class="select2-single form-control" id="bank_account" name="bank_account">
                    <option value="" disabled selected>{{ __('common.Select account') }}</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->display }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
</div>
