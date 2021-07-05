
$("#todos").on("click", function () {
    $(".case").prop("checked", this.checked);
});

// if all checkbox are selected, check the selectall checkbox and viceversa  
$(".case").on("click", function () {
    if ($(".case").length == $(".case:checked").length) {
        $("#todos").prop("checked", true);
    } else {
        $("#todos").prop("checked", false);
    }
});