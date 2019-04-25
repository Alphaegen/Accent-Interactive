<script type="text/javascript">
$(function() {
  var selUser;
  var empty = false;
  var valid;
  var valEmail;

  function Validation() {
    if ($(selUser + ' input[type="email"]').val().indexOf("@") != -1 && $(selUser + ' input[type="email"]').val().indexOf(".") != -1) {
      valEmail = true;
    } else {
      alert("Wrong Email");
      valEmail = false;
    };

    $(selUser + ' input[type="text"]').each(function(){
      if($(this).val()=="") {
         empty = true;
         alert("Fill in all info");
         return false;
      } else {
        empty = false;
      }

    });

    if (empty==false && valEmail==true) {
      valid = 1;
     }else{
      valid = 0;
     }
  };



  $(".edit-btn, .finish-btn").click(function(){
    var selUser = "." + $(this).parent().parent().attr('class');
    $(selUser + " .edit-btn").toggleClass("hidden");
    $(selUser + " .finish-btn").toggleClass("hidden");
    $(selUser + " .remove-btn").toggleClass("hidden");


    if ($(selUser + " input").attr('readonly')) {
      $(selUser + " input").removeAttr('readonly')
    } else {
      $(selUser + " input").attr('readonly', true);
    }});



// Finish User Edit
  $(".user-finish-submit").click(function(){
    var selUser = "." + $(this).parent().parent().attr('class');
    if($(selUser + ".fname").val() != ""){

      $.ajax({
        method: "POST",
        url: "<?=editfile?>",
        data: { fname: $(selUser + " .fname").val(),
                infix: $(selUser + " .infix").val(),
                lname: $(selUser + " .lname").val(),
                email: $(selUser + " .email").val(),
                telephone: $(selUser + " .telephone").val(),
                sname: $(selUser + " .sname").val(),
                snumber: $(selUser + " .snumber").val(),
                city: $(selUser + " .city").val(),
                postcode: $(selUser + " .postcode").val(),
                country: $(selUser + " .country").val(),
                wrong_logins: $(selUser + " .wrong_logins").val(),
                user_role: $(selUser + " .user_role").val(),
                confirmed: $(selUser + " .confirmed").val(),
                id: $(selUser + " .id").val(),
                user: 1
              }
      }).done(function( msg ) {
          if(msg !== ""){
            alert(msg);
          }else{
            location.reload();
          }
      });
    }else{
      alert("Please fill all fields with valid data!");
    }
  });



// Remove User
  $(".user-remove-submit").click(function(){
    var remUser = "." + $(this).parent().parent().attr('class');
    if($(remUser + " .id").val() != ""){

      $.ajax({
        method: "POST",
        url: "<?=removefile?>",
        data: {
                id: $(remUser + " .id").val(),
                user: 1
              }
      }).done(function( msg ) {
          if(msg !== ""){
            alert(msg);
          }else{
            location.reload();
          }
      });
    }else{
      alert("User couldn't be removed");
    }
  });



 // Add User
 $(".user-add-submit").click(function(){
   selUser = "." + $(this).parent().parent().attr('class');

   Validation();
   if (valid==1) {
     $("#dialog-form").dialog();
   }
 });


 $("#conf-button").click(function() {
   pass = $("#password").val();
   confPass = $("#conf-password").val();

   if (pass != confPass) {
     delete confPass;
     delete pass;
     alert('Passwords don\'t match')
   } else {
     console.log(selUser);


 $.ajax({
   method: "POST",
   url: "<?=addfile?>",
   data: { fname: $(selUser + " .fname").val(),
           infix: $(selUser + " .infix").val(),
           lname: $(selUser + " .lname").val(),
           email: $(selUser + " .email").val(),
           telephone: $(selUser + " .telephone").val(),
           sname: $(selUser + " .sname").val(),
           snumber: $(selUser + " .snumber").val(),
           city: $(selUser + " .city").val(),
           postcode: $(selUser + " .postcode").val(),
           country: $(selUser + " .country").val(),
           wrong_logins: $(selUser + " .wrong_logins").val(),
           user_role: $(selUser + " .user_role").val(),
           confirmed: $(selUser + " .confirmed").val(),
           password: confPass,
           user: 1
         }
 }).done(function( msg ) {
   delete password;
     if(msg !== ""){
       alert(msg);
     }else{
       location.reload();
     }
 });
}
})
});

</script>
