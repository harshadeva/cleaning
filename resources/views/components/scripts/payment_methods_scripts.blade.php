<script>
        $(document).ready(function() {
            $('#payment_method').on('change', function() {
                $('#chequeDiv').hide();
                $('#bankDiv').hide();

                if (this.value == 2) {
                    $('#chequeDiv').fadeIn();
                }else if(this.value == 3){
                    $('#bankDiv').fadeIn();
                }
            });

            $('#effected').val("{{date('Y/m/d')}}").trigger('change');

            /* cheque details : start*/
            @error('confirmation')
                $('#submitBtn').addClass('btn-danger').html('Confirm & Submit').val('cheque_cofirmed');
            @enderror
            @error('existing_number')
                $('#cheque_number').val("{{ $errors->first('existing_number') }}");
            @enderror
            /* cheque details : end */



            /* Update : start */
            @if (isset($record))
                @if (isset($record->amount))
                    $('#amount').val("{{$record->amount}}");
                @endif
                @if (isset($record->payment_method_id))
                    $('#payment_method').val("{{$record->payment_method_id}}").trigger('change');
                @endif
                @if (isset($record->effected_date))
                    $('#effected').val("{{ date('Y/m/d',strtotime($record->effected_date)) }}");
                @endif

                @if (isset($record->payment_method_id) && $record->payment_method_id == 2 && isset($record->cheque))
                    $('#cheque_date').val("{{$record->cheque->cheque_date}}").trigger('change');
                @endif
                @if (isset($record->payment_method_id) && $record->payment_method_id == 3 && isset($record->bankBooks) && $record->bankBooks()->latest()->first() != null)
                    $('#bank_account').val("{{$record->bankBooks()->latest()->first()->bank_account_id}}").trigger('change');
                @endif
            @endif

            @if (isset($selectedIncome))
                @if (isset($selectedIncome->amount))
                    $('#amount').val("{{$selectedIncome->amount}}");
                @endif
                $('#payment_method').val("{{$selectedIncome->payment_method_id}}").trigger('change');
                $('#effected').val("{{ date('Y/m/d',strtotime($selectedIncome->effected_date)) }}");

                @if ($selectedIncome->payment_method_id == 2 && isset($selectedIncome->cheque))
                    $('#cheque_date').val("{{$selectedIncome->cheque->cheque_date}}").trigger('change');
                @endif
                @if ($selectedIncome->payment_method_id == 3 && isset($selectedIncome->bankBooks) && $selectedIncome->bankBooks()->latest()->first() != null)
                    $('#bank_account').val("{{$selectedIncome->bankBooks()->latest()->first()->bank_account_id}}").trigger('change');
                @endif
            @endif
            /* Update : end */


            /* Page Refresh Old Value : start */
            @if (old('payment_method') != null)
                $('#payment_method').val("{{old('payment_method')}}").trigger('change');
            @endif
              @if (old('effected') != null)
                $('#effected').val("{{old('effected')}}").trigger('change');
            @endif
            @if (old('cheque_date') != null)
                $('#cheque_date').val("{{old('cheque_date')}}").trigger('change');
            @endif
            @if (old('bank_account') != null)
                $('#bank_account').val("{{old('bank_account')}}").trigger('change');
            @endif
            /* Page Refresh Old Value : end */


        });

    </script>
