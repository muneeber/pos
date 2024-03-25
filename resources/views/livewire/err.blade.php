<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
@script
    <script>
        // Wait for the DOM to be ready
          // $this->dispatch('notifyError', 'No Products Added');
        $(document).ready(function() {
            $wire.on('notifyError', (e) => {
                $.notify(`${e}`, "error");
            });
            $wire.on('modalError', (error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops... Error",
                    text: `${error}`,
                });
            });
        });
        </script>
    @endscript