<script type="text/javascript">
    $(document).ready(function () {
        var urls = [];
        var matched = [];
        $('a').each(function () {
            urls.push($(this).attr('href'));
        });

        $.ajax({
            url: './backend/pages/url-matcher',
            data: {urls: urls, _token: $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            success: function (res) {
                res = jQuery.parseJSON(res);
                if (res.message === 'ok') {
                    matched = res.data;
                    removeunmatched(matched);
                }
            }.bind(matched)
        });

        function removeunmatched(matched) {
            if (matched.length > 0) {
                $('a').each(function () {
                    var href = $(this).attr('href');
                    if (matched.indexOf(href) === -1) {
                        $(this).closest('button.btn').remove();
                        $(this).remove();
                    }
                });
            }
        }
    });
</script>


