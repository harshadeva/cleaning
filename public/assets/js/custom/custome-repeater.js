/*
--------------------------------------
    : Custom - Repeater js :
--------------------------------------
*/
"use strict";
 $(document).ready(function() {
            $('.repeater').repeater({
                show: function() {
                    $(this).slideDown();
                    $('.select2-container').remove();
                    $('.select2-single').select2({});
                     $('.autoclose-date').filter(function() { if($(this).val() != "") return ;
                    $(this).datepicker({
                        language: 'en',
                        autoClose: true,
                        dateFormat: 'yyyy/mm/dd',
                    });});

                    $('.select2-container').css('width', '100%');
                },
                hide: function(deleteElement) {

                    if (confirm('Are you sure you want to delete this element?')) {
                        if ($(this).data('repeater-delete-url')) {
                            let url = $(this).data('repeater-delete-url');
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                success: function(data) {
                                    if (data.successMessage != null) {
                                        $(this).slideUp(deleteElement);
                                    }
                                }
                            });
                        } else {
                            $(this).slideUp(deleteElement);

                        }
                    }
                }
            });
        });

