<script>
    function ajaxPost(url, payload) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "POST",
                url: url,
                data: payload,
                success: function (data) {
                    resolve(data)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.responseText != undefined) {
                        $(document).Toasts('create', {
                            title: 'Error',
                            body: JSON.parse(XMLHttpRequest.responseText).message,
                            class: 'bg-danger',
                            autohide: true,
                        })
                        reject(JSON.parse(XMLHttpRequest.responseText).message)
                    }
                }
            });
        })
    }

</script>
