function SubmitFormData() {
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();

    $.post("submit.php", { name: name, email: email, message: message },
    function(data) {
	 $('#results').html(data);
	 $('#myForm')[0].reset();
    });
}