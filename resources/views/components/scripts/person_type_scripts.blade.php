<script>
        $(document).ready(function() {

              $('#person_type').on('change', function() {

                $('#supplierDiv').hide();
                $('#studentDiv').hide();
                $('#teacherDiv').hide();
                $('#student').val('').trigger('change');
                $('#supplier').val('').trigger('change');
                $('#teacher').val('').trigger('change');

                if (this.value == 1) {
                    $('#studentDiv').fadeIn();
                } else if(this.value == 2) {
                    $('#supplierDiv').fadeIn();
                } else if(this.value == 3) {
                    $('#teacherDiv').fadeIn();
                }
            });

            @if (isset($record))
                @if($record->person != null )
                    $('#person_type').val("{{$record->person_type}}").trigger('change');
                    @if($record['person_type'] == 1)
                        $('#student').val("{{$record->person_id}}").trigger('change');
                    @endif
                    @if($record['person_type'] == 2)
                        $('#supplier').val("{{$record->person_id}}").trigger('change');
                    @endif
                      @if($record['person_type'] == 3)
                        $('#teacher').val("{{$record->person_id}}").trigger('change');
                    @endif
                @endif
            @endif

            @if (old('person_type') != null)
                $('#person_type').val("{{old('person_type')}}").trigger('change');
            @endif
            @if (old('student') != null)
                $('#student').val("{{old('student')}}").trigger('change');
            @endif
             @if (old('supplier') != null)
                $('#supplier').val("{{old('supplier')}}").trigger('change');
            @endif
             @if (old('teacher') != null)
                $('#teacher').val("{{old('teacher')}}").trigger('change');
            @endif

        });

    </script>
