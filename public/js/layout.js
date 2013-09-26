$(function() {
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img_prev').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#icon_path').change(function() {
            readURL(this);
        });
    });
    
    
});