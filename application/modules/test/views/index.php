<div id="exec">
    
</div>
<p>
    <button id="btn_exec">Click</button>
</p>
<script>
    $('#btn_exec').click(function (){
       $('#exec').append('<a href="#"><img class="imgNew" width="320px" height="180px" class="newIMG" src="http://sontrt.tk/hmvc/public/images/1379672798_big_big_buck_bunny.jpg" /></a>'); 
    });
    $('#exec .imgNew').load(function (){
        alert('122');
    });
</script>