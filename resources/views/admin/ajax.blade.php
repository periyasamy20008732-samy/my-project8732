<script type="text/javascript">
  
    $(function() {
        var baseUrl = $('meta[name=app-url]').attr("content");
        let url = baseUrl + '/tax';
        // create a datatable
        $('#projects_table').DataTable({
            processing: true,
            ajax: url,
            "order": [[ 0, "desc" ]],
            columns: [
                { data: 'tax_name'},
                { data: 'description'},
                { data: 'action'},
            ],
              
        });
      });
      
  
    function reloadTable()
    {
        /*
            reload the data on the datatable
        */
        $('#projects_table').DataTable().ajax.reload();
    }
  
    /*
        check if form submitted is for creating or updating
    */
    $("#save-project-btn").click(function(event ){
        event.preventDefault();
        if($("#update_id").val() == null || $("#update_id").val() == "")
        {
            storeProject();
        } else {
            updateProject();
        }
    })
  
    /*
        show modal for creating a record and 
        empty the values of form and remove existing alerts
    */
    function createProject()
    {
        $("#alert-div").html("");
        $("#error-div").html("");
        $("#update_id").val("");
        $("#name").val("");
        $("#description").val("");
        $("#form-modal").modal('show'); 
    }
  
    /*
        submit the form and will be stored to the database
    */
    function storeProject()
    {   
        $("#save-project-btn").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/projects";
        let data = {
            name: $("#name").val(),
            description: $("#description").val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#save-project-btn").prop('disabled', false);
                let successHtml = '<div class="alert alert-success" role="alert"><b>Project Created Successfully</b></div>';
                $("#alert-div").html(successHtml);
                $("#name").val("");
                $("#description").val("");
                reloadTable();
                $("#form-modal").modal('hide');
            },
            error: function(response) {
                $("#save-project-btn").prop('disabled', false);
                if (typeof response.responseJSON.errors !== 'undefined') 
                {
    let errors = response.responseJSON.errors;
    let descriptionValidation = "";
    if (typeof errors.description !== 'undefined') 
                    {
                        descriptionValidation = '<li>' + errors.description[0] + '</li>';
                    }
                    let nameValidation = "";
    if (typeof errors.name !== 'undefined') 
                    {
                        nameValidation = '<li>' + errors.name[0] + '</li>';
                    }
      
    let errorHtml = '<div class="alert alert-danger" role="alert">' +
        '<b>Validation Error!</b>' +
        '<ul>' + nameValidation + descriptionValidation + '</ul>' +
    '</div>';
    $("#error-div").html(errorHtml);            
}
            }
        });
    }
  
  
    /*
        edit record function
        it will get the existing value and show the project form
    */
    function editProject(id)
    {
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let project = response.project;
                $("#alert-div").html("");
                $("#error-div").html("");
$("#update_id").val(project.id);
$("#name").val(project.name);
$("#description").val(project.description);
$("#form-modal").modal('show'); 
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }
  
    /*
        sumbit the form and will update a record
    */
    function updateProject()
    {
        $("#save-project-btn").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + $("#update_id").val();
        let data = {
            id: $("#update_id").val(),
            name: $("#name").val(),
            description: $("#description").val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "PUT",
            data: data,
            success: function(response) {
                $("#save-project-btn").prop('disabled', false);
                let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                $("#alert-div").html(successHtml);
                $("#name").val("");
                $("#description").val("");
                reloadTable();
                $("#form-modal").modal('hide');
            },
            error: function(response) {
                $("#save-project-btn").prop('disabled', false);
                if (typeof response.responseJSON.errors !== 'undefined') 
                {
    let errors = response.responseJSON.errors;
    let descriptionValidation = "";
    if (typeof errors.description !== 'undefined') 
                    {
                        descriptionValidation = '<li>' + errors.description[0] + '</li>';
                    }
                    let nameValidation = "";
    if (typeof errors.name !== 'undefined') 
                    {
                        nameValidation = '<li>' + errors.name[0] + '</li>';
                    }
      
    let errorHtml = '<div class="alert alert-danger" role="alert">' +
        '<b>Validation Error!</b>' +
        '<ul>' + nameValidation + descriptionValidation + '</ul>' +
    '</div>';
    $("#error-div").html(errorHtml);            
}
            }
        });
    }
  
    /*
        get and display the record info on modal
    */
    function showProject(id)
    {
        $("#name-info").html("");
        $("#description-info").html("");
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + id +"";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let project = response.project;
                $("#name-info").html(project.tax_name);
$("#description-info").html(project.description);
$("#view-modal").modal('show'); 
  
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }
  
    /*
        delete record function
    */
    function destroyProject(id)
    {
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + id;
        let data = {
            name: $("#name").val(),
            description: $("#description").val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "DELETE",
            data: data,
            success: function(response) {
                let successHtml = '<div class="alert alert-success" role="alert"><b>Project Deleted Successfully</b></div>';
                $("#alert-div").html(successHtml);
                reloadTable();
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }
</script>