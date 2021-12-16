@if($user_role->is_super==0)
<script>
    //Role Actions
    $(document).ready(function () {
        var role_actions = jQuery.parseJSON('<?= json_encode($role_actions) ?>');
        $('*[data-action]').each(function () {
            var action = $(this).data('action');
            if (role_actions.indexOf(action) === -1) {
                $(this).remove();
            }
        });
    });
</script>
@endif

