var AppSwitch = function() {
    // Other functions...

    var initBootstrapSwitch = function() {
        if ($.fn.bootstrapSwitch) {
            $(".make-switch").each(function() {
                $(this).bootstrapSwitch();
            });
        }
    };

    // Other functions...

    return {
        // Other functions...
        initBootstrapSwitch: function() {
            initBootstrapSwitch();
        },
        // Other functions...
    };
}();

$(function () {
    // Ajax CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // air Date Picker
    if ($.isFunction($.fn.datepicker)) {
        $('.air-date-picker').each(function () {
            $(this).datepicker({
                language: 'en',
                isMobile: true,
                autoClose: true,
                multipleDatesSeparator: " - "
            });
        });
    }

    // request Validate
    if ($('#request-form').length > 0) {
        requestValidate($('#request-form'), $('#request-btn'));
    }

    //tinyMCE Editor
    if($('.tinyMCE').length > 0)
    {
        var directionality = "ltr";
        tinymce.init({
            selector: '.tinyMCE',
            min_height: 500,
            valid_elements: '*[*]',
            relative_urls: false,
            remove_script_host: false,
            directionality: directionality,
            language: 'en',
            menubar: 'file edit view insert format tools table help',
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code codesample fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: 'code preview | undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | image media link | fullscreen',
            content_css: ['/app-assets/vendor/tinymce/editor_content.css'],
        });
        tinymce.DOM.loadCSS('/app-assets/vendor/tinymce/editor_ui.css');
    }

});

$(document).ajaxStart(function () {
    var e = $(".portlet").children(".portlet-body");
    App.blockUI({
        target: e,
        animate: true,
        overlayColor: "none"
    });
});

$(document).ajaxComplete(function () {
    var e = $(".portlet").children(".portlet-body")
    App.unblockUI(e);
});

//START: Sweetalert 
function ajaxMessage(status, msg) {
    if (status == 1) {
        swal({
            title: "Success! 😊",
            text:msg,
            type: 'success',
            allowOutsideClick: true,
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonClass: 'btn btn-success',
            closeOnConfirm: true,
            closeOnCancel: false,
            confirmButtonText: 'OK'
        });
    } else {
        swal({
            title: "Error! 😯",
            text:msg,
            type: 'error',
            allowOutsideClick: true,
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonClass: 'btn btn-danger',
            closeOnConfirm: true,
            closeOnCancel: false,
            confirmButtonText: 'OK'
        });
    }
}

function errorsHTMLMessage(msg) {
    swal({
        title: "Error! 😯",
        html:msg,
        type: 'error',
        allowOutsideClick: true,
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonClass: 'btn btn-danger',
        closeOnConfirm: true,
        closeOnCancel: false,
        confirmButtonText: 'OK'
    });
}

function infoHTMLMessage(msg) {
    Swal.fire({
        icon: 'info',
        title: 'Info! 😐',
        showDenyButton: true,
        showCancelButton: true,
        html: msg,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        } else if (result.isDenied) {
            return false;
        }
    });
}
//END: Sweetalert



// Common Ajax Table Loader
function loadAjaxTable(dataParam = {}) {
    var table_url = $('#master-data-table').data('filter-url');
    $.ajax({
        type: "GET",
        url: table_url,
        data: dataParam,
        success: function (data) {
            $('#ajax_data').html(data);
            $('#total_item_msg').html($('#temp_total_item_msg').html());
            AppSwitch.initBootstrapSwitch();
            enableFilterButton();
        },
        error: function (data) {
            ajaxMessage(0, "Something went wrong.!");
            enableFilterButton();
        }
    });
}

// Ajax Export BTN For Multiple Export Options
$(document).ready(function () {
    // Listen for change event on select element with class 'js-select2'
    $('#export-btn').change(function () {
        // Get the selected option
        var selectedOption = $(this).find('option:selected');

        // Get the data-url attribute value
        var url = selectedOption.data('url');

        // Check if data-url attribute exists and is not empty
        if (url) {
            var newTab = window.open(url, '_blank');

            // Close the tab after a delay
            setTimeout(function () {
                newTab.close();
            }, 3000); // Adjust the delay (in milliseconds) as needed
        }
    });
});

function enableFilterButton()
{
    var button = $('.page-content > .row:first-child button');
    button.prop('disabled', false);
}

function disableFilterButton()
{
    var button = $('.page-content > .row:first-child button');
    button.prop('disabled', true);
}

// Common Filter
function ajaxFilter(page = 0) {
    disableFilterButton();
    var per_page_item = $('#filter_per_page_item').val();
    let dataParam = {
        per_page_item: per_page_item,
        page: page
    }
    var mergedParam = dataParam;
    var mergedParam = $.extend({}, getThisParams(), dataParam);

    loadAjaxTable(mergedParam);
}

// Only Validator
$(function () {
    $('.custom-form-validator').each(function () {
        $(this).validate({
            rules: {
            },
            messages: {
                title: "Oops.! The Title field is required.",
                category_id: "Oops.! The Category field is required.",
                image: "Oops.! The Image field is required.",
                description: "Oops.! The Descripation field is required.",
                keyword: "Oops.! The Keywords field is required.",
                content: "Oops.! The Content field is required.",
                username: "Username field is required.",
                email: "Email field is required.",
                password: "Password field is required.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // Save Editor tinyMCE Editor
                if ($('.tinymce').length > 0) {
                    tinymce.triggerSave();
                }

                form.submit();
            }
        });
    });
});

function requestValidate(formParam, btnParam) {
    formParam.validate({
        rules: {
        },
        messages: {
            title: "Oops.! The Title field is required.",
            category_id: "Oops.! The Category field is required.",
            image: "Oops.! The Image field is required.",
            description: "Oops.! The Descripation field is required.",
            keyword: "Oops.! The Keywords field is required.",
            content: "Oops.! The Content field is required.",
            username: "Username field is required.",
            email: "Email field is required.",
            password: "Password field is required.",
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (f) {
            var btn = btnParam, btn_old_html = btn.html(),
                form = formParam;

            btn.attr('disabled', true);
            btn.html('<i class="fa fa-cloud-upload"></i> Requesting');

            // Save Editor tinyMCE Editor
            if ($('.tinymce').length > 0) {
                tinymce.triggerSave();
            }

            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function (data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.data);

                        // reset form
                        if (form.data('reset-form') == true) {
                            form[0].reset();
                        }
                        // Check if the table with id "master-data-table" exists
                        if ($('#master-data-table').length > 0) {
                            // Call the loadAjaxTable() function
                            loadAjaxTable();
                        }

                        //close modal
                        if (form.data('modal-popup') == true) {
                            // close request modal
                            if (form.data('modal-type') == 'request') {
                                $('#request-modal').modal('hide');
                            }
                            // close request edit modal
                            if (form.data('modal-type') == 'request-edit') {
                                $('#request-modal-edit').modal('hide');
                            }
                        }
                    } else {
                        if (typeof data.data === 'object') {
                            var error = "<ul>";
                            $.each(data.data, function (key, value) {
                                error += "<li>" + key + ": " + value + "</li>";
                            });
                            error += "</ul>";
                            errorsHTMLMessage(error);
                        }
                        else {
                            ajaxMessage(0, data.data);
                        }
                    }
                    btn.attr("disabled", false);
                    btn.html(btn_old_html);

                },
                error: function (data) {
                    var msg = data.responseJSON.message,
                        error = "<ul>";

                    $.each(data.responseJSON.errors, function (key, value) {
                        error += "<li>" + value + "</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg);
                    btn.attr("disabled", false);
                    btn.html(btn_old_html);

                }
            });

            return false;
        }
    });
}

function callUpdate(e) {
    var url = e.attr('href');
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        success: function (data) {
            $('#editData').html(data);
            $('#request-modal-edit').modal('show');
        },
        error: function (data) {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
}

// Common Ajax Delete
function callDelete(e, is_delete = true) {
    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: 'warning',
        allowOutsideClick: true,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        closeOnConfirm: true,
        closeOnCancel: true,
        confirmButtonText: 'Yes, Proceed!'
    }, function(confirmed) {
        if (confirmed) {
            if(is_delete)
            {                
                var url = e.attr('href'), old_html = e.html();
                e.html('Deleting');
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {

                    },
                    success: function (data) {
                        ajaxMessage(1, data.data);
                        // Check if the table with id "master-data-table" exists
                        if ($('#master-data-table').length > 0) {
                            // Call the loadAjaxTable() function
                            ajaxFilter();
                        }
                        e.html(old_html);
                    },
                    error: function (data) {
                        ajaxMessage(0, "Something went wrong.!");
                        e.html(old_html);

                    }
                });
            }
            else{
                setTimeout(() => {                    
                    ajaxMessage(0, "You don't have permission to delete the item.");
                }, 1000);
            }
        }
    });
}

// Common Status Change
// function changeStatus(checkbox) {
//     var url = checkbox.data('url');
    
//     $.ajax({
//         type: "put",
//         url: url,
//         data: {},
//         success: function (data) {
//             if (data.status === true) {
//                 checkbox.prop('checked', !checkbox.prop('checked'));
//                 ajaxMessage(1, data.data);
//             } else {
//                 ajaxMessage(0, data.data);
//                 return false;
//             }
//         },
//         error: function (data) {
//             ajaxMessage(0, "Something went wrong.!");
//             return false;
//         }
//     });
// }



// Pages On Click Events
$(function () {
    // Booking Filter
    $('#filter_search_by').on('change', function () {
        // Get the selected option value
        var selectedValue = $(this).val();

        // Call the appropriate method based on the selected option
        switch (selectedValue) {
            case 'name':
                $('#filter_name_p').css('display', 'inline-block');
                $('#filter_payment_status_p, #filter_balance_due_p, #filter_menu_choose_p').css('display', 'none');
                break;
            case 'payment_status':
                $('#filter_payment_status_p').css('display', 'inline-block');
                $('#filter_name_p, #filter_balance_due_p, #filter_menu_choose_p').css('display', 'none');
                break;
            case 'balance_due':
                $('#filter_balance_due_p').css('display', 'inline-block');
                $('#filter_name_p, #filter_payment_status_p, #filter_menu_choose_p').css('display', 'none');
                break;
            case 'menu_choose':
                $('#filter_menu_choose_p').css('display', 'inline-block');
                $('#filter_name_p, #filter_payment_status_p, #filter_balance_due_p').css('display', 'none');
                break;
            case 'event_date':
                $('#filter_event_date_p').css('display', 'inline-block');
                break;
            case 'date_booking_submitted':
                $('#filter_date_booking_submitted_p').css('display', 'inline-block');
                break;
            default:
                // Default action if no specific method is defined
                break;
        }

    });


    // order for on change
    $('#order_for').on('change', function () {
        var selectedValue = $(this).val();
        $('#existing_user_detail').css('display', 'none');
        $('#existing_user_detail').html('');
        if (selectedValue == '0') {
            $('#order_new_customer_details').css('display', 'block');
            $('#order_existing_customer_details').css('display', 'none');
            $('#user_id').val('');
        }
        else {
            if (hasUsers === false) {
                getUsersforOrder();
                hasUsers = true;
            }
            $('#order_new_customer_details').css('display', 'none');
            $('#order_existing_customer_details').css('display', 'block');
        }

    });

    // User on change - orders
    $('#order_existing_customer_details #user_id').on('change', function () {
        var selectedValue = $(this).val(), url = '/admin/ajax/get-customer-by-id/' + selectedValue;
        if (selectedValue != null && selectedValue != '') {

            $.ajax({
                type: "get",
                url: url,
                data: {

                },
                success: function (data) {
                    $('#existing_user_detail').html(data);
                    $('#order_new_customer_details').css('display', 'none');
                    $('#existing_user_detail').css('display', 'block');

                },
                error: function (data) {
                    ajaxMessage(0, "Something went wrong.!");

                }
            });
        }
        else {

            $('#order_new_customer_details').css('display', 'none');
            $('#existing_user_detail').css('display', 'none');
        }
    });

    // Order -- Event Date onChange
    if ($.isFunction($.fn.datepicker)) {
        $("#event_date").datepicker({
            language: 'en',
            isMobile: true,
            autoClose: true,
            multipleDatesSeparator: " - ",
            onSelect: function () {
                $(this).change();
                eventDateChange();
            }
        });
    }
});

// Order -- Event Date onChange
function eventDateChange() {
    var selectedValue = $('#event_date').val(), url = '/admin/ajax/get-booking-date-by-date';

    $.ajax({
        type: "get",
        url: url,
        data: {
            event_date: selectedValue
        },
        success: function (data) {
            $('#select_no_of_table').html(data.html);
            $('#select_no_of_table').css('display', 'block');
            $('#total_tables').html('');

            $('#event_id_input').html(data.event_id_input);
            $('#event_id_input').css('display', 'block');

            $('#event_price_per_person').html(data.event_price);
            $('#event_price_per_person').css('display', 'block');
        },
        error: function (data) {
            $('#select_no_of_table').html('');
            $('#select_no_of_table').css('display', 'none');
            $('#total_tables').html('');

            $('#event_id_input').html('');
            $('#event_id_input').css('display', 'none');

            $('#event_price_per_person').html('');
            $('#event_price_per_person').css('display', 'none');

            ajaxMessage(0, "Something went wrong.!");

        }
    });
}

// Order -- No Of Table 
function OnNoOfTableChange() {
    var table_of = 10, tables = $('#no_of_table').val(), html = '', total_tables = $('#total_tables'), sample_html = $('#sample_of_table_ten').html();
    if ($('#no_of_table').prop('name') == 'no_of_table_of_twelve') {
        table_of = 12;
        sample_html = $('#sample_of_table_twelve').html()
    }
    for (let i = 1; i <= tables; i++) {
        html += sample_html;
    }

    total_tables.html(html);
};

// order create update prices
function orderUpdatePrices()
{
    var price_per_person = $('#booking_price_per_person'), 
    table_data = $('#total_tables').find('select[name="table_data[]"]'), 
    deposit_paid = $('#deposit_paid'), 
    discount = $('#discount'), 
    balance_due = $('#balance_due'), 
    total_amount = $('#total_amount'),
    
    price_ppc_val = parseInt(price_per_person.data('price')) || 0,
    discount_val = parseInt(discount.val()) || 0,
    total_people = 0, discount_amt = 0, total_price = 0;

    // calculating total People
    table_data.each(function(){
        $item_val = parseInt($(this).val()) || 0;
        total_people += $item_val;
    });

    //total Price
    total_price = price_ppc_val*total_people;

    // calculate total discount amt
    if(discount_val !== 0)
        discount_amt = (total_price * discount_val)/100;

    var net_amount = total_price-discount_amt;

    
    // assigning values
    if(deposit_paid.val() <= 0)
        deposit_paid.val(20*total_people);//20 for each person for booking
    
    total_amount.val(net_amount);
    balance_due.val(net_amount-deposit_paid.val());   
    
}

//Get all users or create Order Page
function getUsersforOrder() {

    var url = $('#user_id').data('url');
    $.ajax({
        type: "get",
        url: url,
        data: {

        },
        success: function (data) {
            $('#user_id').html(data.data);

        },
        error: function (data) {
            ajaxMessage(0, "Something went wrong.!");

        }
    });
}

function getSettings(el){
    var url = el.attr('href');
    $.ajax({
        type: "GET",
        url: url,
        data: {
            language_id:el.val()
        },
        success: function (data) {
            $('#formData').html(data);
            $('#actionBTN').show();
        },
        error: function (data) {
            ajaxMessage(0, "Please Select The Language.!");
            $('#formData').html('');
            $('#actionBTN').hide();
        }
    });
}

function getItemByLanguageId(e) {
    var $es = $('.update-on-language-change');
    if ($es.length > 0) {
        $es.each(function () {
            var $element = $(this); // Store reference to $(this) in a variable

            var url = $element.attr('href');
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    language_id: e.val()
                },
                success: function (data) {
                    $element.html(data); // Use the stored reference here
                },
                error: function (data) {
                    ajaxMessage(0, "Please Select The Language.!");
                    $element.html(''); // Use the stored reference here
                }
            });
        });
    }
}

function convertToSlug(Text) {
    return Text.toLowerCase()
        .replace(/[^\w ]+/g, "")
        .replace(/ +/g, "-");
}

function makeSlug(e)
{
    $('#slug').val(convertToSlug(e.val()));
}