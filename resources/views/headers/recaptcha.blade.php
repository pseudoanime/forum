<script src="https://www.google.com/recaptcha/api.js?render={{$recaptchaSiteKey}}"></script>
<script>
    $(document).ready(function () {
        $("button").click(function (e) {
            e.preventDefault();
            grecaptcha.execute({{$recaptchaSiteKey}}, {action: 'register'}).then(function (token) {
                var input = $("<input>").attr("type", "hidden").attr("name", "g-recaptcha-response").val(token);
                $('#registerForm').append(input);
                $("#registerForm").submit();
            });
        });
    });
</script>