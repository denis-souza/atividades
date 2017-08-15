function saveForm(form) {
  $.ajax({
    url: '/home/activities/save',
    type: 'post',
    data: form.serialize(),
    success: function(result) {
      var data = JSON.parse(result);

      if (data.status == 'success') {
        $('.list').prepend('<div class="alert alert-success">' + data.msg + '</div>');
        $('#addActivityModal').modal('toggle'); 
        location.reload();
      }
      else {
        $('.list').prepend('<div class="alert alert-warning">' + data.msg + '</div>');
        $('#addActivityModal').modal('toggle');

      }
    }
  });
}

function modalActivity(param = null) {
  
  var str_required = "Esse campo é obrigatório!";

  $('.modal-body').load('/home/activities/form', { aid: param }, function(result) {
    $('#addActivityModal').modal({show:true});
      
    $('.input-date').datepicker({
      language: 'pt-BR'
    });

    $('#form-activity').validate({
      rules: {
        name: {
          required: true,
          maxlength: 255,
        },
        description: {
          required: true,
          maxlength: 600,
        },
        begin_date: {
          required: true
        },
        end_date: {
          required: function(element) {
            return ($("#status").val() == 4);
          }
        },
        situation: {
          required: true
        }
      },
      messages: {
        name: {
          required: str_required,
          maxlength: 'O preenchimento máximo é de 255 caracteres!',
        },
        description: {
          required: str_required,
          maxlength: 'O preenchimento máximo é de 600 caracteres!',
        },
        begin_date: str_required,
        end_date: str_required,
        situation: {
          required: 'Marque umas das opções!',
        }
      },
      submitHandler: function(form) {
        saveForm($('#form-activity'));
      }
    });
  });
}

$(document).ready(function() {

  $(".add-activity").click(function() {
    modalActivity();
  });

  $(".edit-activity").click(function(e) {
    e.preventDefault();
    modalActivity($(this).data('aid'));
  });
});