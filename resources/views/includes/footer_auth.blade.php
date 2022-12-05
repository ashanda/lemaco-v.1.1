<!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>
    <script>$('select[name="topic"]').on('change',function(){
   if($(this).val()=="Employment query")
   {
    	$('.upload').hide();
        $('.callback').show();
   }
   else
   {
        $('.upload').show();
        $('.callback').hide();
   }
   
});</script>
    
</body>
</html>