<label for="account" class="control-label">{{ __('common.Account') }}</label>
<div>
    <div class="input-group">

        <select id="account" name="account" class="select2-single form-control">
            <option value="" selected disabled>{{ __('common.Select account') }}</option>
            @if (isset($accounts) && $accounts != null)
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->display }}
                    </option>
                @endforeach
            @endif
        </select>

    </div>
</div>
