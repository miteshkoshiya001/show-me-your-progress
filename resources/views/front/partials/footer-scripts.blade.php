<script src="{{ asset('frt-assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frt-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frt-assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frt-assets/js/select2.min.js') }}"></script>
<script src="{{ asset('frt-assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/loader.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://unpkg.com/feather-icons'></script>

@yield('page-js')

<script>
    $(document).ready(function() {

        /* Add Lazy Loading in all images */
        const allImages = $('img');
        if (allImages.length > 0) {
            $.each(allImages, function(i, item) {
                if ($(item).attr("id") != 'cropme-image') {
                    $(item).attr("loading", "lazy");
                }
            });
        }
        /* Add Lazy Loading in all images */
        $('#feedbackForm').submit(function(e) {
            e.preventDefault();

            var email = $('#formEmail').val();
            var message = $('#formMessage').val();

            if (email.length < 5 || message.length < 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Email and message must be at least 5 characters long.'
                });
                return;
            }

            // Validations passed, proceed to API call
            var formData = {
                email: email,
                feedback: message
            };

            $(".feeback-loader").removeClass('d-none');
            $.ajax({
                type: 'POST',
                url: apiUrl + '/api/feedback',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    $('#feedbackForm')[0].reset();
                    $(".feeback-loader").addClass('d-none');
                },
                error: function(xhr, status, error) {
                    $(".feeback-loader").addClass('d-none');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            });
        });
    });
</script>
