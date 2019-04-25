<script type="text/javascript">
$(function() {
// Finish Event Edit
  $(".event-finish-submit").click(function(){
    var selEvent = "." + $(this).parent().parent().attr('class');
    if($(selEvent + ".event").val() != ""){

      $.ajax({
        method: "POST",
        url: "<?=editfile?>",
        data: { img: $(selEvent + " .img").val(),
                eventname: $(selEvent + " .eventname").val(),
                seats: $(selEvent + " .seats").val(),
                starttime: $(selEvent + " .starttime").val(),
                endtime: $(selEvent + " .endtime").val(),
                city: $(selEvent + " .city").val(),
                address: $(selEvent + " .address").val(),
                description: $(selEvent + " .description").val(),
                smalldesc: $(selEvent + " .smalldesc").val(),
                price: $(selEvent + " .price").val(),
                id: $(selEvent + " .id").val(),
                event: 1
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



// Remove Event
  $(".event-remove-submit").click(function(){
    var remEvent = "." + $(this).parent().parent().attr('class');
    if($(remEvent + " .id").val() != ""){

      $.ajax({
        method: "POST",
        url: "<?=removefile?>",
        data: {
                id: $(remEvent + " .id").val(),
                event: 1
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



 // Add Event
 $(".event-add-submit").click(function(){
   selEvent = "." + $(this).parent().parent().attr('class');

 $.ajax({
   method: "POST",
   url: "<?=addfile?>",
   data: { img: $(selEvent + " .img").val(),
           eventname: $(selEvent + " .eventname").val(),
           seats: $(selEvent + " .seats").val(),
           starttime: $(selEvent + " .starttime").val(),
           endtime: $(selEvent + " .endtime").val(),
           city: $(selEvent + " .city").val(),
           address: $(selEvent + " .address").val(),
           description: $(selEvent + " .description").val(),
           smalldesc: $(selEvent + " .smalldesc").val(),
           price: $(selEvent + " .price").val(),
           id: $(selEvent + " .id").val(),
           event: 1
          }
 }).done(function( msg ) {
     if(msg !== ""){
       alert(msg);
     }else{
       location.reload();
     }
 });
});
});

</script>
