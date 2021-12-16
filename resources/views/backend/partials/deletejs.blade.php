<script>
    $(document).ready(function () {
        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm("هل انت متأكد من حذف هذا ؟")) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                beforeSend: function () {
                    button.hide();
                },
                success: function (response) {
                    button.closest('tr').remove();
                    alert('تم الحذف بنجاح');
                }
            });
    
    
    
        });
    });
</script>

<script type="text/javascript">
    $('.delete22').click(function (e) {
        e.preventDefault();
        var me = $(this);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    method:'post',
                    url: $(this).attr('href'),
                    success: function (response) {
                      if (response.status === 'ok') {
                        if (me.closest('tr').length > 0){
                          me.closest('tr').remove();
                        }
                        swal('Deleted!', response.message, 'success');
                      } else {
                        swal('Can not be Deleted!', response.message, 'warning');
                      }
                    }
            
                  });
            }
        })
    });
  </script>