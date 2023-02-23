jQuery(document).ready(function ($) {
      const d = new Date("2023-10-23");
      let month = 1 + d.getMonth();
      if (month <= 9) {
            month = "0" + month;
      }
      $("#bid").click(function (e) {
            $.ajaxSetup({
                  headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                  }
            });
            e.preventDefault();
            var bidData = {
                  'auction_id': jQuery('#auction_id').val(),
                  'user_id': jQuery('#user_id').val(),
                  'offer_datetime': now(),
                  'offer_price': $request
            }
      });
});