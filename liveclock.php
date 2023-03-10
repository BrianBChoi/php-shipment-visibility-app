<?php
  Function d1() {
    $time1 = Time();
    $date1 = date("h:i:s A",$time1);
    echo $date1;
  }
?>

<script>
  var now = new Date(<?php echo time() * 1000 ?>);
  function startInterval(){
    setInterval('updateTime();', 1000);
  }
  startInterval();//start it right away
  function updateTime(){
    var nowMS = now.getTime();
    nowMS += 1000;
    now.setTime(nowMS);
    var clock = document.getElementById('liveclock');
    if(clock){
      clock.innerHTML = now.toTimeString();//adjust to suit
    }
  }
</script>

<div id="liveclock">Binex IT PHP Training - Liveclock Test</div>
