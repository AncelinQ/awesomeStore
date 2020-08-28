var $j = jQuery.noConflict();

$j(function () {
  $j("#ipBtn").click(function (e) {
    e.preventDefault();

    $j.ajax({
      url: "https://api.ipify.org?format=json",
      dataType: 'json',
      success: function (json) {
        $j("#ipAddressDisplay").html(
          "Mon addresse IP est : " + json.ip
        );
      },
    });
  });
});