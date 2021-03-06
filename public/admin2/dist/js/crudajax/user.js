$(document).on('click','.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Crear nuevo usuario');
});
$("#add").click(function() {
    $.ajax({
        type: 'POST',
        url: 'create',
        data: {
            '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'password': $('input[name=password]').val(),
            'id_rol': $('input[name=id_rol]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
                $('.error').text(data.errors.email);
                $('.error').text(data.errors.password);
                $('.error').text(data.errors.id_rol);
            } else {
                $('.error').remove();
                $('#table').append("<tr class='users" + data.id + "'>"+
                    "<td>" + data.id + "</td>"+
                    "<td>" + data.name + "</td>"+
                    "<td>" + data.email + "</td>"+
                    "<td>" + data.password + "</td>"+
                    "<td>" + data.id_rol + "</td>"+
                    "<td>" + data.created_at + "</td>"+
                    "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email + "' data-password='" + data.password + "' + data-id_rol='" + data.id_rol + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email + "' data-password='" + data.password + "' + data-id_rol='" + data.id_rol + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email  + "' data-password='" + data.password + "' + data-id_rol='" + data.id_rol + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
                    "</tr>");
            }
        },
    });
    $('#name').val('');
    $('#email').val('');
    $('#password').val('');
    $('#id_rol').val('');
});

// function Edit POST
$(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update Post");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Post Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#t').val($(this).data('title'));
    $('#b').val($(this).data('body'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function() {
    $.ajax({
        type: 'POST',
        url: 'editPost',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#fid").val(),
            'title': $('#t').val(),
            'body': $('#b').val()
        },
        success: function(data) {
            $('.post' + data.id).replaceWith(" "+
                "<tr class='post" + data.id + "'>"+
                "<td>" + data.id + "</td>"+
                "<td>" + data.title + "</td>"+
                "<td>" + data.body + "</td>"+
                "<td>" + data.created_at + "</td>"+
                "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete Post');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.title').html($(this).data('title'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function(){
    $.ajax({
        type: 'POST',
        url: 'deletePost',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('.post' + $('.id').text()).remove();
        }
    });
});

// Show function
$(document).on('click', '.show-modal', function() {
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#na').text($(this).data('name'));
    $('#e').text($(this).data('email'));
    $('#p').text($(this).data('password'));
    $('#r').text($(this).data('rol'));
    $('.modal-title').text('Ver usuarios');
});