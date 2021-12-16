<script>
    $(document).ready(function () {
        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm("Are You sure you want to delete")) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'post',
                beforeSend: function () {
                    button.hide();
                },
                success: function (response) {
                    button.closest('tr').remove();
                    alert('Data deleted successfully')
                    button.closest('tr').remove();
                },error:function(){
                    alert('something went wrong');
                }
            });
    
    
    
        });
    });
</script>

