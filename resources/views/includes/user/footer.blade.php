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
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

<script>
       /* $(document).ready(function () {

            setInterval( function() {
                $("#sample").load(location.href + " #sample");
             }, 5000 );

        });*/
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

</script> 
<script>
  $(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
$('#dbType').on('change',function(){
    if( $(this).val()==="nic"){
    $("#otherType").show();
    $("#pass").show();
    }
    else if( $(this).val()==="passport"){
    $("#otherType").show();
    
    }
    else if( $(this).val()==="driving"){
    $("#otherType").show()
    $("#pass").show();
    }  
    else{
    $("#otherType").hide()
    }
});

</script>  
<script>  
(function($) {
  "use strict"


var dzChartlist = function(){

var screenWidth = $(window).width();
var marketChart = function(){
   var options = {
        series: [{
        name: 'series1',
        data: [200, 400, 400, 300, 500, 200, 200,400, 300, 300]
      }, {
        name: 'series2',
        data: [500, 300, 200, 400, 600, 400, 400, 300, 500, 200]
      }],
        chart: {
        height: 350,
        type: 'area',
    toolbar:{
      show:false
    }
      },
  colors:["#FFAB2D","#00ADA3"],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
      },
  legend:{
    show:false
  },
  grid:{
    borderColor: '#EEEEEE',
  },
  yaxis: {
    labels: {
    style: {
      colors: '#787878',
      fontSize: '13px',
      fontFamily: 'Poppins',
      fontWeight: 400
      
    },
    formatter: function (value) {
      return value + "k";
    }
    },
  },
      xaxis: {
        categories: ["Week 01","Week 02","Week 03","Week 04","Week 05","Week 06","Week 07","Week 08","Week 09","Week 10"],
    labels:{
      style: {
      colors: '#787878',
      fontSize: '13px',
      fontFamily: 'Poppins',
      fontWeight: 400
      
    },
    }
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      },
      };

      var chart = new ApexCharts(document.querySelector("#marketChart"), options);
      chart.render();
}
var currentChart = function(){
   var options = {
        series: [85, 60, 67, 50],
        chart: {
        height: 350,
        type: 'radialBar',
      },
      plotOptions: {
        radialBar: {
      startAngle:-90,
       endAngle: 90,
          dataLabels: {
            name: {
              fontSize: '22px',
            },
            value: {
              fontSize: '16px',
            },
          }
        },
      },
  stroke:{
     lineCap: 'round',
  },
      labels: ['Income', 'Income', 'Imcome', 'Income'],
   colors:['#ec8153', '#70b944','#498bd9','#6647bf'],
      };

      var chart = new ApexCharts(document.querySelector("#currentChart"), options);
      chart.render();
}

var recentContact = function(){
  jQuery('.testimonial-one').owlCarousel({
    loop:true,
    autoplay:true,
    margin:20,
    nav:false,
    rtl:true,
    dots: false,
    navText: ['', ''],
    responsive:{
      0:{
        items:3
      },
      450:{
        items:4
      },
      600:{
        items:5
      },	
      991:{
        items:5
      },			
      
      1200:{
        items:7
      },
      1601:{
        items:5
      }
    }
  })
}


/* Function ============ */
  return {
    init:function(){
    },
    
    
    load:function(){
        marketChart();
        currentChart();
        recentContact();
        
    },
    
    resize:function(){
    }
  }

}();


  
jQuery(window).on('load',function(){
  setTimeout(function(){
    dzChartlist.load();
  }, 1000); 
  
});

jQuery(window).on('resize',function(){
  
  
});     

})(jQuery);

function clipboardClicked1(){
const alert = document.getElementById('clickedMessage-1')
  alert.style.display = "inline-block"

  setTimeout(function(){ 
      alert.style.display = "none"

  }, 500);
}
function clipboardClicked2(){
const alert = document.getElementById('clickedMessage-2')
  alert.style.display = "inline-block"

  setTimeout(function(){ 
      alert.style.display = "none"

  }, 500);
}
$(this).popover({
            html:true
        });
</script>
<script>
  function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("deposit_add");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/62e0e4e137898912e95fdb6c/1g8v7s4u6';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
</body>
</html>
