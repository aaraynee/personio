var Upload = {
    // Setup elements we will reuse
    el: {
        new: $('.upload-new'),
        content: $('.content'),
        hierarchy: $('.hierarchy'),
        error: $('.error'),
        form: $('#upload')
    },
    // Initialise any actions
    init: function(){
        Upload.el.form.submit(function(e) {Upload.formSubmit(e)})
    },
    // Handle form submissions
    formSubmit: function(e) {
        // Set input values, we can't do this in init as we need to retrieve current values.
        var input = {
            json: $('[name="json"]').val(),
            file: $('[name="hierarchy"]').val()
        };
        e.preventDefault();
        Upload.hideError();
        Upload.hideHierarchy();
        // If no input exists, show error.
        if (input['file'] == "" && input['json'] == "") {
            Upload.showError('<p>No input file or json.</p>');
            return;
        } else if(input['json']) {
            Upload.getHierarchy(JSON.parse(input['json']));
        }
    },
    // Hide and show elements.
    // @TODO Clean up functions as we can optimise these.
    hideError: function() {
        Upload.el.error.html('').hide();
    },
    showError: function(message) {
        Upload.el.error.html(message).show();
    },
    hideHierarchy: function() {
        Upload.el.hierarchy.html('').hide();
    },
    showHierarchy: function(structure) {
        Upload.el.hierarchy.html(structure).show();
    },
    hideContent: function() {
        Upload.el.content.hide();
    },
    showContent: function() {
        Upload.el.content.show();
    },
    // Make ajax call to get hierarchy.
    getHierarchy: function(json) {
        $.ajax({
            url: "/api/hierarchy",
            type: "post",
            data: json
        })
            .done(function(response) {
                var hierarchyString = Upload.getChildren(response);
                Upload.hideContent();
                Upload.showHierarchy(hierarchyString + '<br><a class="upload-new" href="javascript:;">Upload New</a>');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                Upload.showError('<p>'+jqXHR.responseJSON+'</p>');

            });
    },
    // Build hierarchy chart.
    getChildren: function(array) {
        var hierarchyString = '<ul>';
        for(var employee in array) {
            hierarchyString += '<li>'+employee;
            if(array[employee].length) {
                array[employee].forEach(function(children){
                    hierarchyString += Upload.getChildren(children)
                })
            }
            hierarchyString += '</li>';
        }
        hierarchyString += '</ul>';
        return hierarchyString
    }
}

$(function(){
    Upload.init();

    // As we add an element after upload we need to create watch for action on this element.
    $(document).on('click', '.upload-new', function() {
        Upload.hideHierarchy();
        Upload.showContent();
    })
});