$(document).ready(function(){
   fb.ready(function(){ 
        if (fb.logged)
        {
            $('#fb-logged').val('1');
            $('#nombrefb').val(fb.user.name);
            $('#emailfb').val(fb.user.email);
            $('#fotofb').val(fb.user.picture);
        }
   });
   
})


