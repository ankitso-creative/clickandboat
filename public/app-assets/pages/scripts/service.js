$(function () {
    setTimeout(() => {
        makeDescriptionEditor();
        makeLFM();        
        addIndexToSectionInput();
    }, 1000);
});

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


function makeLFM()
{
    $('.lfm').each(function () {
        $(this).filemanager('image');
    });
}


// add dynamic sections
async function addSection(section, type) {
    jQuery("#sectionModal").addClass('loading');

    const templateUrl = `${jQuery(section).attr('data-url')}/${type}`;
    const $previewElement = jQuery("#template-preview");
    const preview = jQuery('#preview');
    const templateRequest = await fetch(templateUrl, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const template = await templateRequest.json();
    if (template?.status) {
        const previousHtml = $previewElement.html();
//        $previewElement.html(previousHtml + template?.html);
        $previewElement.append(template?.html);
        addIndexToSectionInput();
        makeLFM();
    }

    closeModal();
    setTimeout((e) => {
        makeDescriptionEditor(type);
    }, 1500);
    jQuery("#sectionModal").removeClass('loading');
}
//close modal
function closeModal() {
    $('.modal').modal('toggle');
}

//image upload
jQuery(document).on('change', ".imageUpload", function () {
    readURL(this);
});

function readURL(input) {
    const $target = jQuery(input).attr('data-target');
    const $targetElement = jQuery(`${$target}`);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $targetElement.css('background-image', 'url(' + e.target.result + ')');
            $targetElement.hide();
            $targetElement.fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//remove section from the view
function removeSection(section) {
    const element = jQuery(document).find(`#${section}`);
    if (element?.length) {
        element.fadeOut(300, function () {
            $(this).remove();
            addIndexToSectionInput();
        });
    }
}

// move section up & donw
function moveSectionUp(elem) {
    let col = elem.closest('.section-preview');
    col.prev().before(col);
    
    addIndexToSectionInput();
    
    setTimeout(() => {
        makeDescriptionEditor();
    }, 1000); // Delay of 2000 milliseconds (2 seconds) after moving
}

function moveSectionDown(elem) {
    let col = elem.closest('.section-preview');
    col.next().after(col);

    addIndexToSectionInput();
    
    setTimeout(() => {
        makeDescriptionEditor();
    }, 1000); // Delay of 1000 milliseconds (1 second) after moving
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
            console.log(description);
        }
        
        index++; 
    }); 
}

function addIndexToSectionInput() {
    var sections = $("input[name='section_type[]']");
    var sectionIndex = 0;

    sections.each(function() {
        var section = $(this).closest('.section-preview');
        
        // Initialize a map to hold counters for different input names
        var counters = {};

        // Handle all inputs within the section
        section.find('input[type="text"], textarea').each(function() {
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
        console.log(sectionIndex);
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