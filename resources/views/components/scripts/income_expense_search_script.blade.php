<script>
 $(document).ready(function() {

            @if(isset($search->from) && $search->from != null)
                $('#from').val("{{ date('Y/m/d',strtotime($search->from)) }}");
            @endif

            @if(isset($search->to) && $search->to != null)
                $('#to').val("{{ date('Y/m/d',strtotime($search->to)) }}");
            @endif
             @if(isset($search->status) && $search->status != null)
                $('#status').val("{{$search->status }}").trigger('change');
            @endif
            @if(isset($search->person_type) && $search->person_type != null)
                $('#person_type').val("{{ $search->person_type }}").trigger('change');
                @if($search->person_type == 1)
                    $('#studentDiv').fadeIn();
                    $('#student').val("{{ $search->student }}").trigger('change');
                @elseif($search->person_type == 2)
                    $('#supplierDiv').fadeIn();
                    $('#supplier').val("{{ $search->supplier }}").trigger('change');
                @elseif($search->person_type == 3)
                    $('#teacherDiv').fadeIn();
                    $('#teacher').val("{{ $search->teacher }}").trigger('change');
                @endif
            @endif

            $('#person_type').on('change', function() {
                if (this.value == 1) {
                    $('#supplierDiv').hide();
                    $('#teacherDiv').hide();
                    $('#studentDiv').fadeIn();
                    // $('#supplier').val('').trigger('change');
                } else if(this.value == 2) {
                    $('#studentDiv').hide();
                    $('#teacherDiv').hide();
                    $('#supplierDiv').fadeIn();
                    // $('#student').val('').trigger('change');
                }
                 else if(this.value == 3) {
                    $('#studentDiv').hide();
                    $('#supplierDiv').hide();
                    $('#teacherDiv').fadeIn();
                    // $('#student').val('').trigger('change');
                }
                else{
                     $('#supplierDiv').hide();
                    $('#studentDiv').hide();
                    $('#teacherDiv').hide();
                    // $('#student').val('').trigger('change');
                    // $('#supplier').val('').trigger('change');

                }
            });


        });
</script>
