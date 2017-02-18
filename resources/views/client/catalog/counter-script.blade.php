<script>
    var maxValue = $('#model-amount').data('value');
    var isCartPage = "{{ $is_cart_page or 0 }}";

    function updateQuantity(id,value){
        if(!value) return false;
        $.ajax({
            type: "PATCH",
            url: '{{ url("/cart") }}' + '/' + id,
            data: {
                'quantity': value
            },
            success: function(data) {
                window.location.href = '{{ url('/cart') }}';
            }
        });
    }

    // Buttons
    $('.le-button.disabled').click(function(e){
        e.preventDefault();
    });

    // Quantity Spinner
    $('.le-quantity a').click(function(e){
        e.preventDefault();
        var targetValue;
        var currentQty= $(this).parent().parent().find('input').val();
        if( $(this).hasClass('minus') && currentQty>1){
            targetValue = parseInt(currentQty, 10) - 1;
            $(this).parent().parent().find('input').val(targetValue);
        }else{
            if( $(this).hasClass('plus')){
                if(currentQty >= maxValue) return false;
                targetValue = parseInt(currentQty, 10) + 1;
                $(this).parent().parent().find('input').val(targetValue);
            }
        }

        if(+isCartPage) {
            var id = $(this).parents('form').attr('data-id');
            updateQuantity(id,targetValue);
        }
    });
</script>