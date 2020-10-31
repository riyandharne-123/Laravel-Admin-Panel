  @if(session()->has('message'))
          <script type="text/javascript">
            swal("{{session()->get('message')}}","", "success");
          </script>
          @elseif(session()->has('error'))
               <script type="text/javascript">
            swal("{{session()->get('error')}}","", "error");
          </script>
          @endif