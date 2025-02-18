var id_ = 'draggable-full';
var cols_ = document.querySelectorAll('#' + id_ + ' .draggable-column');
var dragSrcEl_ = null;

$(function (){
    draggable();
});

function handleDragStart(e) {
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);

    dragSrcEl_ = this;

    // Destroy select2 instances before dragging
    destroySelect2Instances();

    this.classList.add('moving');
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault(); // Allows us to drop.
    }

    e.dataTransfer.dropEffect = 'move';

    return false;
}

function handleDragEnter(e) {
    this.classList.add('over');
}

function handleDragLeave(e) {
    // this/e.target is previous target element.
    this.classList.remove('over');
}

function handleDrop(e) {
    // this/e.target is current target element.

    if (e.stopPropagation) {
        e.stopPropagation(); // stops the browser from redirecting.
    }

    // Don't do anything if we're dropping on the same column we're dragging.
    if (dragSrcEl_ !== this) {
        dragSrcEl_.innerHTML = this.innerHTML;
        this.innerHTML = e.dataTransfer.getData('text/html');
    }

    return false;
}

function handleDragEnd(e) {
    // this/e.target is the source node.
    [].forEach.call(cols_, function (col) {
        col.classList.remove('over');
        col.classList.remove('moving');
    });
    
    addIndexToSectionInput();

    // Re-initialize select2 instances
	setTimeout(ComponentsSelect2.init(), 5000);
	setTimeout(makeDescriptionEditor, 1000);
}

let draggable = () => {
    cols_ = document.querySelectorAll('#' + id_ + ' .draggable-column');
    [].forEach.call(cols_, function(col) {
        col.setAttribute('draggable', 'true'); // Enable columns to be draggable.
        col.addEventListener('dragstart', handleDragStart, false);
        col.addEventListener('dragenter', handleDragEnter, false);
        col.addEventListener('dragover', handleDragOver, false);
        col.addEventListener('dragleave', handleDragLeave, false);
        col.addEventListener('drop', handleDrop, false);
        col.addEventListener('dragend', handleDragEnd, false);
    });
}

function destroySelect2Instances() {
    $('.js-data-example-ajax').each(function() {
        var $this = $(this);
        if ($this.data('select2')) {
            $this.select2('destroy');
            // Remove Select2-generated elements
            $this.next('.select2-container').remove();
            console.log('Destroyed Select2 instance for:', $this.attr('class'));
        }
    });
}