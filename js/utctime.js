/*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
$(document).ready(

  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $("#status").html("jQuery is loaded and ready.");
  }


);

        function updTime() {
        var f = new Date();
        document.getElementById('local').innerHTML =  "<strong>Local: </strong>" + f;
        document.getElementById('universal').innerHTML = "<strong>Universal: </strong>" + f.toUTCString();
    }
        function startClock() {
        setInterval(function () { updTime() }, 1000);
    }
    startClock();
