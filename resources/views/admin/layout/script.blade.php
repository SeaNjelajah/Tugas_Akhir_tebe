<script>
    function post(path, params, method='post') {

    // The rest of this code assumes you are not using a library.
    // It can be made less verbose if you use one.
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = params[key];

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();

    }
</script>

<script>

    $('a[set=sweet-alert-delete]').on('click', (e) => {
        source = e.target;
        url = source.getAttribute('url');
        token = source.getAttribute('token');
        method = source.getAttribute('method');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                post (url, { _token: token, _method: method,  });
            }
        });

    });

</script>

<script>
    var success = (value) => {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
        }).fire({
            icon: 'success',
            title: value
        });
    }

    var failed = (value) => {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
        }).fire({
            icon: 'error',
            title: value
        });
    }

</script>

@if ($value = session()->get('success'))
<script>
    $(document).ready ( () => {
        success ('{{ $value }}');
    });
</script>
@endif

@if ($value = session()->get('failed'))
<script>
    $(document).ready ( () => {
        failed ('{{ $value }}');
    });
</script>
@endif

