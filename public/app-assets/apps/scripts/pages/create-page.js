var order = 5, benefit_order = 100;
$(function () {
    // Search Section Items
    $('#search-section-items').on('keyup', function() {
        var inputValue = $(this).val().toLowerCase();

        $('.section-items').each(function() {
            var itemType = $(this).data('type').toLowerCase();

            if (itemType.indexOf(inputValue) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    addIndexToSectionInput();
    // Validating Form
    $('.request-form').each(function() {
        $(this).validate({
            rules: {
                
            },
            messages: {
                
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.validate-it').append(error);
                console.log(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('validate');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('validate');
            },
            submitHandler: function(form) {
                console.log('submit');
                form.submit();
            }
        });
    });
    var tarea = $('textarea');
    if(tarea.length > 0)
    {
        tarea.each(function(){
            $(this).on('input', resizeTextarea);            
        });
    } 

    makeLFM();

    // on language change
    $('#language_id').change(function () {
        $('#draggable-full').html('');
    });

    $('#add-section-btn').click(function () {
        $('#addSectionModal').modal('show');
    });

    // Modal Overright
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
        var $modalElement = this.$element;
        $(document).on('focusin.modal', function (e) {
            if ($modalElement.length > 0 && $modalElement[0] !== e.target
                && !$modalElement.has(e.target).length
                && $(e.target).parentsUntil('*[role="dialog"]').length === 0) {
                $modalElement.focus();
            }
        });
    };

    // Make Description Editor
    makeDescriptionEditor();
});

function makeLFM()
{
    $('.lfm').each(function(){
        $(this).filemanager('image');
    });
}

function makeDescriptionEditor() {
    let index = 1;

    //Destroy all instance
    for (let instance in CKEDITOR.instances) {
        if (CKEDITOR.instances.hasOwnProperty(instance)) {
            let editor = CKEDITOR.instances[instance];
            if (editor && editor.element && editor.element.$ && document.body.contains(editor.element.$)) {    
                editor.updateElement();            
                editor.destroy(true);            
            }
            delete CKEDITOR.instances[instance];
        }
    }

    $('.description').each(function() {
        let description = $(this), editorID = 'editor_description_' + index;
        description.attr('id', editorID);

        if(description.attr('ckeditor-init') === 'init')
        {
            description.removeAttr('ckeditor-init');
        }

        // Initialize CKEditor if not already initialized
        if (!description.attr('ckeditor-init')) {
            CKEDITOR.replace(editorID, {
                removeButtons: 'Underline,Subscript,Superscript',
                toolbarGroups: [
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                    { name: 'links', groups: ['links'] },
                ],
                height: 300,
                removePlugins: 'elementspath',
                resize_enabled: false,
                extraAllowedContent: 'a[*]; h1 h2 h3 h4 h5 h6', // Allow h1 and h2 tags
                format_tags: 'p;h1;h2;h3;h4;h5;h6;pre', // Add h1 and h2 to format tags
                // Custom toolbar with formatting options including h1 and h2
                toolbar: [
                    { name: 'styles', items: ['Format'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'links', items: ['Link', 'Unlink'] }
                ]
            });
            description.attr('ckeditor-init', 'init');            
        }
        
        index++; 
    }); 

    
    
}


function editSection(id) {
    var url = '/admin/ajax/edit-section/' + id;

    $.ajax({
        type: "GET",
        url: url,
        data: {},
        success: function (data) {
            $('#sectionEditModalContent').html(data);
            $('#sectionEditModal').modal('show');
            $('#sectionEditModalTitle').html($('#sectionEditModalTitleTemp').html());
        },
        error: function (data) {
            ajaxMessage(0, "Please Select The Language.!");
            $('#sectionEditModalContent').html('');
            $('#sectionEditModalTitle').html('Title');
        }
    });
}

function addSection(elem) {
    let blade_name = elem.data('blade-name'), url = '/admin/ajax/edit-section/' + blade_name;

    $.ajax({
        type: "GET",
        url: url,
        data: {},
        success: function (html) {
            $('#draggable-full').append(html);
            draggable();
            setTimeout(() => {                
                makeDescriptionEditor();
                makeLFM();
                addIndexToSectionInput();
            }, 1000);
            $('#addSectionModal').modal('hide');
        },
        error: function (data) {
            alert('Something Went Wrong.');
        }
    });    
}

function addAirport(elem)
{
    let id = elem.val();
    elem.val('');
    elem.next('.select2-container').find('.select2-selection__rendered').html('Select Airport');
    let input_values = $('#airport-section input[name="airports[]"]').map(function () {
        return $(this).val();
    }).get();

    if (input_values.includes(id)) {
        alert('Already Added');
        return false;
    }

    let url = "/admin/ajax/airport-append/"+id;

    $.ajax({
        type:'get',
        url:url,
        data:{
            language_id: $('#language_id').val() === '' ? 1 : $('#language_id').val(),
        },
        success: function(response){
            $('#airport-section').append(response);
        }, 
        error: function (response){
            alert('Something went wrong.');
        }
    });
}

function addFaq(elem)
{
    let id = elem.val(), faq_container = elem.closest('.draggable-column').find('.faq-container');
    elem.val('');
    elem.next('.select2-container').find('.select2-selection__rendered').html('Select FAQ');
    let input_values = faq_container.find('input.faq-ids').map(function () {
        return $(this).val();
    }).get();

    if (input_values.includes(id)) {
        alert('Already Added');
        return false;
    }

    let url = "/admin/ajax/faq-append/"+id;

    $.ajax({
        type:'get',
        url:url,
        data:{
            language_id: $('#language_id').val() === '' ? 1 : $('#language_id').val(),
        },
        success: function(response){
            faq_container.append(response);              
            addIndexToSectionInput();          
        }, 
        error: function (response){
            alert('Something went wrong.');
        }
    });
}

function addTestimonial(elem)
{
    let id = elem.val(), faq_container = elem.closest('.draggable-column').find('.testimonial-container');
    elem.val('');
    elem.next('.select2-container').find('.select2-selection__rendered').html('Select Testimonial');
    let input_values = faq_container.find('input.testimonial-ids').map(function () {
        return $(this).val();
    }).get();

    if (input_values.includes(id)) {
        alert('Already Added');
        return false;
    }

    let url = "/admin/ajax/testimonial-append/"+id;

    $.ajax({
        type:'get',
        url:url,
        data:{
            language_id: $('#language_id').val() === '' ? 1 : $('#language_id').val(),
        },
        success: function(response){
            faq_container.append(response);              
            addIndexToSectionInput();          
        }, 
        error: function (response){
            alert('Something went wrong.');
        }
    });
}


function removeFaq(elem) {
    var parent = elem.closest('.faq');
    parent.remove();             
    addIndexToSectionInput();      
}

function removeThisTestimonial(elem)
{
    var parent = elem.closest('.testimonial');
    parent.remove();             
    addIndexToSectionInput();      
}

function addPartner()
{
    var html = '<div class="col-md-3 partners-card"><div class="image" id="partner-holder-'+order+'">';
    html += '<img src="/assets/images/partner-1.jpg" />';
    html +='</div><div class="validate-it" style="padding:0"><div class="input-group"><span class="input-group-btn">';
    html += '<a data-input="partner-input-'+order+'" data-preview="partner-holder-'+order+'" class="btn btn-primary lfm"><i class="fa fa-picture-o"></i> Choose</a>';
    html += '</span><input id="partner-input-'+order+'" class="form-control" type="text" name="data[]" value="/assets/images/partner-1.jpg" required>';
    html += '</div></div><i class="fa fa-trash text-danger del" onclick="removeThisPartner($(this))"></i></div>';

    $('#partners-section-cards .add-more-card').before(html);
    makeLFM();
    order++;             
    addIndexToSectionInput();      
}

function removeThisPartner(elem) {
    var parent = elem.closest('.partners-card');
    parent.remove();             
    addIndexToSectionInput();      
}

function addBenefit()
{
    var html = '<div class="col-md-4 benefit-card"><div class="image" id="benefit-holder-'+benefit_order+'"><img src="/assets/images/exclusive-icon-1.png" /></div>';
    html += '<div class="validate-it" style="padding:0"><div class="input-group"><span class="input-group-btn"><a data-input="benefit-input-'+benefit_order+'"data-preview="benefit-holder-'+benefit_order+'" class="btn btn-primary lfm"><i class="fa fa-picture-o"></i> Choose</a></span><input id="benefit-input-'+benefit_order+'" class="form-control"';
    html += 'type="text" name="card_image[]" value="/assets/images/exclusive-icon-1.png" required></div></div>';
    html += '<div class="form-group text-center validate-it">';
    html += '<input type="text" class="form-control title-input" name="card_title[]" placeholder="Enter Your Title" value="No Monthly Management Fees"  required />';
    html += '</div>';
    html += '<div class="form-group validate-it">';
    html += '<textarea class="form-control" name="card_description[]" placeholder="Enter Your Description" required>We do not charge a monthly fee for the management and operation of our account.</textarea>';
    html += '</div>';
    html += '<i class="fa fa-trash text-danger del" onclick="removeThisBenefit($(this))"></i>';
    html += '</div>';

    $('#benefit-section-cards .add-more-card').before(html);
    benefit_order++;             
    addIndexToSectionInput();      
    makeLFM();
}

function addVillSP()
{
    var html = '<div class="col-md-4 benefit-card"><div class="image" id="benefit-holder-'+benefit_order+'"><img src="/assets/images/double-bed.png" /></div>';
    html += '<div class="validate-it" style="padding:0"><div class="input-group"><span class="input-group-btn"><a data-input="benefit-input-'+benefit_order+'"data-preview="benefit-holder-'+benefit_order+'" class="btn btn-primary lfm"><i class="fa fa-picture-o"></i> Choose</a></span><input id="benefit-input-'+benefit_order+'" class="form-control"';
    html += 'type="text" name="sleeping_arrangements_card_image[]" value="/assets/images/double-bed.png" required></div></div>';
    html += '<div class="form-group text-center validate-it">';
    html += '<input type="text" class="form-control title-input" name="sleeping_arrangements_card_title[]" placeholder="Enter Your Title" value="Bedroom '+benefit_order+'"  required />';
    html += '</div>';
    html += '<div class="form-group validate-it">';
    html += '<textarea class="form-control" name="sleeping_arrangements_card_description[]" placeholder="Enter Your Description" required>Large double bedroom with en-suite bathroom. Located on the lower floor with direct external access.</textarea>';
    html += '</div>';
    html += '<i class="fa fa-trash text-danger del" onclick="removeThisBenefit($(this))"></i>';
    html += '</div>';

    $('#benefit-section-cards .add-more-card').before(html);
    benefit_order++;             
    addIndexToSectionInput();   
    makeLFM();   
}

function removeThisBenefit(elem) {
    var parent = elem.closest('.benefit-card');
    parent.remove();             
    addIndexToSectionInput();      
}


function addAircraft(elem)
{
    let id = elem.val();
    elem.val('');
    elem.next('.select2-container').find('.select2-selection__rendered').html('Select Aircraft');
    let input_values = $('#aircraft-section input[name="aircrafts[]"]').map(function () {
        return $(this).val();
    }).get();

    if (input_values.includes(id)) {
        alert('Already Added');
        return false;
    }

    let url = "/admin/ajax/aircraft-append/"+id;

    $.ajax({
        type:'get',
        url:url,
        data:{
            language_id: $('#language_id').val() === '' ? 1 : $('#language_id').val(),
        },
        success: function(response){
            $('#aircraft-section').append(response);
        }, 
        error: function (response){
            alert('Something went wrong.');
        }
    });
}


function removeThisSection(elem) {
    var parent = elem.closest('.draggable-column');
    parent.remove();
    setTimeout(() => {
        addIndexToSectionInput();
    }, 1000);
}

function moveSectionUp(elem) {
    let col = elem.closest('.draggable-column');
    col.prev().before(col);
    
    addIndexToSectionInput();
    
    setTimeout(() => {
        makeDescriptionEditor();
    }, 2000); // Delay of 2000 milliseconds (2 seconds) after moving
}

function moveSectionDown(elem) {
    let col = elem.closest('.draggable-column');
    col.next().after(col);
    
    addIndexToSectionInput();
    
    setTimeout(() => {
        makeDescriptionEditor();
    }, 1000); // Delay of 1000 milliseconds (1 second) after moving
}


function removeThisAirport(elem) {
    var parent = elem.closest('.airport');
    parent.remove();
}


function addIndexToSectionInput() {
    var sections = $("input[name='section_type[]']");
    var sectionIndex = 0;

    sections.each(function() {
        var section = $(this).closest('.draggable-column');
        
        // Initialize a map to hold counters for different input names
        var counters = {};

        // Handle all inputs within the section
        section.find('input[type="text"], textarea, input[type="checkbox"]').each(function() {
            let name = $(this).attr('name');
            let baseName = name.replace(/\[.*?\]/g, ""); // Remove existing indices

            // Initialize counter for this baseName if not already done
            if (!(baseName in counters)) {
                counters[baseName] = 0;
            }

            // Set the new name with section index and individual counter
            $(this).attr('name', baseName + '[' + sectionIndex + '][' + counters[baseName] + ']');

            // Increment the counter for this baseName
            counters[baseName]++;
        });

        sectionIndex++; // Increment section index
    });

    var tarea = $('textarea');
    if(tarea.length > 0)
    {
        tarea.each(function(){
            $(this).on('input', resizeTextarea);            
        });
    }    
}

function resizeTextarea()
{
    $(this).css('height', 'auto'); 
    $(this).css('height', this.scrollHeight + 'px');
}

function preview() {
    let status = $('#status');
    status.val(0);

    let input = '<input type="hidden" name="preview" id="preview_input" value="preview" hidden/>';
    let form = $('#page-request-form');

    form.append(input);

    setTimeout(() => {
        form.submit();
    }, 100);
}

function submitForm() {
    let form = $('#page-request-form');
    let input = $('#preview_input');

    input.remove();

    setTimeout(() => {
        form.submit();
    }, 100);
}

function preventDuplicateSection() {
    const input_values = $('.draggable-column input.section-input').map(function () {
        return $(this).val();
    }).get();

    $('.card-wrapper .card').each(function () {
        const item = $(this);
        const type = item.data('type');
        const value = type === 'DYNAMIC' ? item.data('section-id') : item.data('blade-name');
        const val = (typeof value === 'number') ? value.toString() : value;
        if (input_values.includes(val)) {
            item.closest('.card-wrapper').addClass('dissabled');
        } else if (item.closest('.card-wrapper').hasClass('dissabled')) {
            item.closest('.card-wrapper').removeClass('dissabled');
        }
    });
}

//START: Sweetalert 
function ajaxMessage(status, msg) {
    if (status == 1) {
        swal({
            title: "Success! 😊",
            text: msg,
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
            text: msg,
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


// Map i-frame on change
var iframe = $('#map_iframe'), iframeSRC = iframe.attr('src');
function mapURLChanged(elem)
{
    let url = elem.val();
    var googleMapsEmbedUrlPattern = /^(https:\/\/)(www\.)?(google\.com\/maps\/embed|maps\.google\.com\/maps)\?.*$/;

    if (googleMapsEmbedUrlPattern.test(url)) {
        iframe.attr('src', elem.val());
    } else {
        iframe.attr('src', iframeSRC);
    }
}

function mapLatLngChanged()
{
    let lat = $('#lat').val(), lng = $('#lng').val(), url = 'https://maps.google.com/maps?q='+lat+','+lng+'&z=8&hl=en&output=embed&zoomControl=0&disableDefaultUI=1';
    var googleMapsEmbedUrlPattern = /^(https:\/\/)(www\.)?(google\.com\/maps|maps\.google\.com\/maps)\?.*$/;

    if (googleMapsEmbedUrlPattern.test(url) && (lat != '' && parseInt(lat) > 0) && (lng != '' && parseInt(lng) > 0) ) {
        iframe.attr('src', url);
    } else {
        iframe.attr('src', iframeSRC);
    }
}

function faqToggler(toggler){
    toggler.closest('.faq').toggleClass('active');
}
