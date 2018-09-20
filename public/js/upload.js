var Upload = {
    el: {
        new: $('.upload-new'),
        content: $('.content'),
        hierarchy: $('.hierarchy'),
        error: $('.error'),
        form: $('#upload')
    },
    init: function(){
        Upload.el.form.submit(function(e) {Upload.formSubmit(e)})
    },
    formSubmit: function(e) {
        var input = {
            json: $('[name="json"]').val(),
            file: $('[name="hierarchy"]').val()
        };
        e.preventDefault();
        Upload.hideError();
        Upload.hideHierarchy();
        if (input['file'] == "" && input['json'] == "") {
            Upload.showError('<p>No input file or json.</p>');
            return;
        } else if(input['json']) {
            Upload.getHierarchy(JSON.parse(input['json']));
        }
    },
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

    $(document).on('click', '.upload-new', function() {
        Upload.hideHierarchy();
        Upload.showContent();
    })
});