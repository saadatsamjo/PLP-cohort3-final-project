$.validator.setDefaults({
  submitHandler: function () {
    let formData = $('#ulizaQuestion').serializeArray()
    console.log(formData);
  }
});
$('#ulizaQuestion').validate({
  rules: {
    title: {
      required: true
    },
    description: {
      required: true,
      minlength: 10
    },
  },
  messages: {
    title: {
      required: "Please provide a title for your question"
    },
    description: {
      required: "Please provide a description of your question",
      minlength: "Your description must be at least 10 characters long"
    }
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
  }
});
