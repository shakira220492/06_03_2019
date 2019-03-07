var volume = 0;
var valor = 0;

function playBannerProgress()
{
    var playBannerProgress = document.getElementById("playBannerProgress");
    var v = document.getElementById("my_video");
    
    currentProgressBar = setInterval(function() {

        var videoDuration = parseInt(v.duration);

        var time = v.currentTime;
        var time_int = parseInt(time);

        var porcentaje = (time_int * 100) / videoDuration;

        playBannerProgress.style.width = porcentaje + "%";

        v.onended = function() {
            clearInterval(currentProgressBar);
        };

    }, 2000);
}




