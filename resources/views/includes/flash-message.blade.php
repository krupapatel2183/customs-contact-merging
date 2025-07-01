@push('custom-scripts')
@if ($message = Session::get('success'))
    <script>
        var message = @json($message);
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: message
            });
        });
    </script>
@endif


@if ($message = Session::get('error'))
    <script>
        var message = @json($message);
        $(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: message
            });
        });
    </script>
@endif


@if ($message = Session::get('warning'))
    <script>
        var message = @json($message);
        $(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'warning',
                title: message
            });
        });
    </script>
@endif


@if ($message = Session::get('info'))
    <script>
        var message = @json($message);
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'info',
                title: message
            });
        });
    </script>
@endif

{{-- AJAX Message --}}
<script>
    function notification(res, message){
        if(res=='success'){
            $(function() {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: message
                });
            });
        }

        if(res=='error'){
            $(function() {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                Toast.fire({
                    icon: 'error',
                    title: message
                });

            });
        }
    }

</script>
@endpush
