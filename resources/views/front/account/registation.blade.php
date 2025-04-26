@extends('front.layout.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form id="registationform">
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Name">
                                <p class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email">
                                <p class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password">
                                <p class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                    placeholder="please confirm password">
                                <p class="text-danger"></p>
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="{{ route('account.login')}}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('customjs')
    <script>
        // Handle registration form submission
        $("#registationform").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.processRegistation') }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === false) {
                        const errors = response.errors;
                        const fields = ['name', 'email', 'password', 'confirm_password'];

                        fields.forEach(function(field) {
                            const input = $('#' + field);
                            const errorP = input.next(
                                'p'); // assumes <p> is directly after the input

                            if (errors[field]) {
                                input.addClass('is-invalid');
                                errorP.addClass('invalid-feedback').html(errors[field]);
                            } else {
                                input.removeClass('is-invalid');
                                errorP.removeClass('invalid-feedback').html('');
                            }
                        });
                    }

                    if (response.status === true) {
                        alert(response.message);
                        $('#registationform')[0].reset();
                        $('.form-control').removeClass('is-invalid');
                        $('p.text-danger').removeClass('invalid-feedback').html('');
                        window.location.href = '{{ route('account.login') }}';
                    }

                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                    console.log("Response Text:", xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    </script>
@endsection
