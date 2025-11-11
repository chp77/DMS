<!-- <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="{{asset('js/app.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/graph.js')}}"></script>
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.6"></script>
<!-- <script src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> -->
<!-- <script src="{{asset('js/datetimepicker.js')}}"></script> -->
<!-- <script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> -->
<!-- <script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<script>
    function submitForm() {
        // Disable the submit button to prevent multiple submissions
        $('#submitBtn').prop('disabled', true);

        // Get the form action URL
        var url = $('#myForm').attr('action');

        // Get the form data
        var formData = $('#myForm').serialize();

        // Perform AJAX request
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.statusCode == 422 || response.statusCode == 500) {
                    $('#error').css("display", "block");
                    $('#error').text(response.error[0]);
                    $('#error2').css("display", "block");
                    $('#error2').text(response.error[1]);
                    $('#submitBtn').prop('disabled', false);
                    console.log(response);
                } else if (response.statusCode == 200) {
                    $('#error').css("display", "none");
                    $('#error2').css("display", "none");
                    $('#modal-default').modal("hide");
                    $('[data-dismiss="modal"]').trigger('click');

                    Toast.fire({
                        icon: 'success',
                        title: 'New device added.'
                    });

                    window.location.reload();
                    setTimeout(() => {
                        Fire.$emit("refreshData");
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON.errors.enrollCode && xhr.responseJSON.errors.enrollCode[0]) {
                    $('#error').css("display", "block");
                    $('#error').text(xhr.responseJSON.errors.enrollCode[0]);
                }else if (xhr.responseJSON.errors.licenseKeys && xhr.responseJSON.errors.licenseKeys[0]) {
                    console.log(xhr.responseJSON.errors.licenseKeys[0]);
                    $('#error2').css("display", "block");
                    $('#error2').text(xhr.responseJSON.errors.licenseKeys[0]);
                } else if (xhr.responseJSON.errors.licenseKeys && xhr.responseJSON.errors.licenseKeys[1]) {
                    console.log(xhr.responseJSON.errors.licenseKeys[1]);
                    $('#error2').css("display", "block");
                    $('#error2').text(xhr.responseJSON.errors.licenseKeys[1]);
                } else {
                    $('#error').css("display", "block");
                    $('#error').text(xhr.responseJSON.errors.enrollCode[0]);
                    $('#error2').css("display", "block");
                    $('#error2').text(xhr.responseJSON.errors.licenseKeys[1]);
                }
            },
            complete: function() {
                $('#submitBtn').prop('disabled', false);
            }
        });
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const organizationLinks = document.querySelectorAll(".organization-list");

        organizationLinks.forEach((link) => {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                const organizationId = this.dataset.organizationId;

                // Make an API call with Axios
                axios.post('/organization/switch', { organizationId })
                    .then(response => {
                        // Handle the API response here if needed
                        // console.log(response.data);
                        if (response.data.statusCode == 200) {
                            // Fire.$emit("refreshData");
                            window.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unable to swith the organization!'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            "500",
                            error,
                            "warning"
                        );
                    });
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // When a link is clicked
        $('.organization-list').on('click', function () {
            // Remove the "/" from all links
            $('.organization-list').each(function () {
                $(this).text($(this).text().replace('✓', ''));
                $('.organization-list').css('font-weight', 'normal');
            });

            // Add the "/" to the clicked link
            $(this).text($(this).text() + '✓');
            $(this).css('font-weight', 'bold');
        });
    });
</script>