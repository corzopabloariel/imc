<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/inview.min.js') }}"></script>

<script src="{{ asset('js/resposiveslides.js') }}"></script>

<script>
    $(document).ready(function() {
        $("body").on("click",".alert button.close", function() {
            $(this).closest(".alert").remove();
        });

        url = '{{url()->current()}}';
        $(".collapsible-body").hide();
        $(`a[href="${url}"]`).closest("ul").closest("li").addClass("active");
        $(`a[href="${url}"]`).closest("li").addClass("active");
        $(`a[href="${url}"]`).closest(".collapsible-body").show();
    });
</script>
@yield('script')