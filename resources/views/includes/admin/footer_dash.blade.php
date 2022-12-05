<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="https://mozita.digital/" target="_blank">Mozita Digital</a> 2022</p>
    </div>
</div>          

</div>
<!--**********************************
Main wrapper end
***********************************-->

<!--**********************************
Scripts
***********************************-->
<!-- Required vendors -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/global/global.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Chart piety plugin files -->
<script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

<!-- Apex Chart -->
<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

<script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/deznav-init.js') }}"></script>    
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

<script>
        $(document).ready(function () {

            setInterval( function() {
                $("#sample").load(location.href + " #sample");
             }, 5000 );

        });
        (function() {
  "use strict";

  function copyToClipboard(elem) {
    var target = elem;

    // select the content
    var currentFocus = document.activeElement;

    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;

    try {
      succeed = document.execCommand("copy");
    } catch (e) {
      console.warn(e);

      succeed = false;
    }

    // Restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
      currentFocus.focus();
    }

    if (succeed) {
      $(".copied").animate({ top: -25, opacity: 0 }, 700, function() {
        $(this).css({ top: 0, opacity: 1 });
      });
    }

    return succeed;
  }

  $("#copyButton1, #copyTarget1").on("click", function() {
    copyToClipboard(document.getElementById("copyTarget1"));
  });
  $("#copyButton2, #copyTarget2").on("click", function() {
    copyToClipboard(document.getElementById("copyTarget2"));
  });
})();

</script> 

<script>
  $(function(){
    //get the pie chart canvas
    var cData = JSON.parse(`<?php echo $data['chart_data']; ?>`);
    var ctx = $("#pie-chart");
   
    //pie chart data
    var data = {
      labels: cData.label,
      datasets: [
      {
        label: "Users Count",
        data: cData.data,
        backgroundColor: [
        "#DEB887",
        "#A9A9A9",
        "#DC143C",
        "#F4A460",
        "#2E8B57",
        "#1D7A46",
        "#CDA776",
        ],
        borderColor: [
        "#CDA776",
        "#989898",
        "#CB252B",
        "#E39371",
        "#1D7A46",
        "#F4A460",
        "#CDA776",
        ],
        borderWidth: [1, 1, 1, 1, 1,1,1]
      }
      ]
    };
   
    //options
    var options = {
      responsive: true,
      title: {
      display: true,
      position: "top",
      text: "Last Week Registered Users",
      fontSize: 18,
      fontColor: "#fff"
      },
      legend: {
      display: true,
      position: "bottom",
      labels: {
        fontColor: "#fff",
        fontSize: 16
      }
      }
    };
   
    //create Pie Chart class object
    var chart1 = new Chart(ctx, {
      type: "doughnut",
      data: data,
      options: options
    });
   
  });
  </script>  



</body>
</html>
