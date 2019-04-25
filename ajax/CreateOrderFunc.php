<script>
$(function() {
<?php if(isset($_GET['id'])) { ?>
    // Buy Ticket on Detail Page
    $("#event-buy-btn").click(function(){
      var selUser = "#" + $(this).parent().attr('id');

      if($(selUser + " .quantity").val() >= "1"){

      <?php if (isset($_SESSION['user']['email'])) { ?>

        $.ajax({
          method: "POST",
          url: "<?=payment?>",
          data: { id: "<?=$_GET['id']; ?>",
                  quantity: $(selUser + " .quantity").val(),
                  email: "<?=$_SESSION['user']['email']; ?>"
                }
        }).done(function( msg ) {
            if(msg !== ""){
              alert(msg);
            }else{
              window.location = "<?=adminPage?>";
            }
        });
    <?php } else { ?>
        alert("Please login first.");
    <?php } ?>
      }else{
        alert("Please select the right amount of tickets!");
      }
    });
  <?php } ?>

    // Edit Order
    $(".order-finish-submit").click(function(){
      var selOrder = "." + $(this).parent().parent().attr('class');
      if($(selOrder + " .email").val() != ""){

        $.ajax({
          method: "POST",
          url: "<?=editfile?>",
          data: { email: $(selOrder + " .email").val(),
                  eventname: $(selOrder + " .eventname").val(),
                  seats: $(selOrder + " .seats").val(),
                  total: $(selOrder + " .total").val(),
                  order: 1
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



    // Remove Order
    $(".order-remove-submit").click(function(){
      var remOrder = "." + $(this).parent().parent().attr('class');
      if($(remOrder + " .id").val() != ""){

        $.ajax({
          method: "POST",
          url: "<?=removefile?>",
          data: {
                  id: $(remOrder + " .id").val(),
                  order: 1
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



    // Add Order
    $(".order-add-submit").click(function(){
     selOrder = "." + $(this).parent().parent().attr('class');

    $.ajax({
     method: "POST",
     url: "<?=addfile?>",
     data: { email: $(selOrder + " .email").val(),
             eventname: $(selOrder + " .eventname").val(),
             seats: $(selOrder + " .seats").val(),
             total: $(selOrder + " .total").val(),
             order: 1
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
