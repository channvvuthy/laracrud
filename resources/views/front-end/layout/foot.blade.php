<script>
    $(document).ready(function() {
        var navbarHeight = $('.navbar').height();
        var widowHeight = $(window).height();
        var bodyHeight = $(document).height();
        var contentHeight = widowHeight - navbarHeight;
        $('.content').height(contentHeight);
        @stack('footerScript')
    })
</script>
</body>

</html>
