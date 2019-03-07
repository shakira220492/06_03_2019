//super global variables
var current_video_id = "";
var current_video_name = "";
var current_video_description = "";
var current_video_image = "";
var current_video_content = "";
var current_video_updateDate = "";
var current_video_amount_views = "";
var current_video_amount_comments = "";
var current_video_likes = "";
var current_video_dislikes = "";
var current_video_userId = "";
var current_video_userName = "";

// logIn session: 
var session_userId = "";
var session_userName = "";
var session_userFirstgivenname = "";
var session_userSecondgivenname = "";
var session_userFirstfamilyname = "";
var session_userSecondfamilyname = "";
var session_userEmail = "";
var session_userPassword = "";
var session_userBiography = "";
var session_amountFollowers = "";
var session_amountInfluencers = "";
var session_amountVideos = "";
var session_amountSpecificLists = "";

// EditVideo variables: // EditProfileBundle
var edit_video_id = "";
var edit_video_name = "";
var edit_video_description = "";
var edit_video_image = "";
var edit_video_content = "";
var edit_video_updateDate = "";
var edit_video_amount_views = "";
var edit_video_amount_comments = "";
var edit_video_likes = "";
var edit_video_dislikes = "";
var edit_video_userId = "";
var edit_video_userName = "";

var current_specificlistId = "";
var current_specificListVideoId = "";
var current_videoPosition = "";

//previous and next video
var next_video_image = "";
var previous_video_image = "";

//screen
var total_screen_mode = "incomplete";

//replay
var replay_mode = "false";

//lyrics
var lyricsPosition = 0;


//delete next variable
var firstLineValue = 150;
var secondLineValue = 100;
var thirdLineValue = 50;
var fourthLineValue = 0;
var fifthLineValue = -50;
    
var d_estrofas = 0;
var e_palabras = 0;
    

var estrofaAmount = 40; // es la cantidad de estrofas
var palabraAmount = 40; // este valor varia segun la estrofa... 

var currentVideo_playing = setInterval(function() {
}, 1000);

currentVideo_playingWithFormat = setInterval(function() {
}, 1000);

var animatedLyrics_2 = setInterval(function() {
}, 1);

var currentProgressBar = setInterval(function() {
}, 1);

var replay = setInterval(function() {
}, 1000);

var asignarValores = setInterval(function() {
}, 7000);

var deslize_to_left_interval = setInterval(function() {
}, 1);

var deslize_to_right_interval = setInterval(function() {
}, 1);

var video_speed = 1;

var lyricsWord = new Array(estrofaAmount);
for (var i=0; i<lyricsWord.length; i++)
{
    lyricsWord[i] = new Array(palabraAmount);
    
    for (var j=0; j<lyricsWord[i].length; j++)
    {
        lyricsWord[i][j] = new Array(12);
    }
}

var commentsGroup = new Array(40);
var amount_commentsGroup = 0;

var commentId = "";// CommentVideoBundle
var commentContent = ""; // CommentVideoBundle
var commentLikes = ""; // CommentVideoBundle
var commentDislikes = ""; // CommentVideoBundle
var commentCreationDate = ""; // CommentVideoBundle
var commentUserId = ""; // CommentVideoBundle
var commentUserName = ""; // CommentVideoBundle
var commentVideoId = ""; // CommentVideoBundle
var commentVideoAmountComments = ""; // CommentVideoBundle

// en que bundles se aplica

var videoSize = 3; // HomeBundle->Resources->views->home->configuration->iconImage->videoSize.html.twig (just in case... "3" by default)
var displaceDivs = 1; // HomeBundle->Resources->views->home->configuration->iconImage->videoSize.html.twig (just in case... "2" by default)
var ConfigurationAreaSize = "3";
var mode = "visible";
var bgMode = "withBg";
var statusSpecificVideo = "par";
var repetitions = 0;
var modeContent = "dynamic";

var modeOptions_VideoBundle = "visible";


// PROPIEDADES DE LA VENTANA



var windowId = "";
var windowVideospeed = "";
var windowGeolocalization = "";
var windowVolume = "";
var windowVideosize = "";
var windowConfigurationareasize = "";
var windowCurrentvideo = "";
var windowCurrentlist = "";
var windowReplay = "";
var windowThemeconfigurationarea = 0; // 1: available 0: unavailable
var windowThemesessionarea = 0; // 1: available 0: unavailable
var windowThemepresentationarea = 0; // 1: smallest, 2: small, 3: big, 4: biggest
var windowThemecolor = 0; // 1: dark 0: light
// graphic variables
var configurationArea_right = 540; // HomeBundle->close.html.twig
var configurationArea_width = 900; // HomeBundle->close.html.twig
var sessionArea_right = 180; // HomeBundle->close.html.twig
var sessionArea_width = 540; // HomeBundle->close.html.twig
var presentationArea_width = $(window).width() - 180; // HomeBundle->close.html.twig
var searchBar_width = 180;





            
            


var comentVideoFrame_bottom = 0;

function showVideo(
            videoId, 
            videoName, 
            videoDescription, 
            videoImage, 
            videoContent, 
            videoUpdateDate, 
            videoAmountViews, 
            videoAmountComments, 
            videoLikes, 
            videoDislikes,
            userId, 
            userName
        )
{
    clearInterval(currentVideo_playing); // EditLyricsBundle
    clearInterval(currentVideo_playingWithFormat); // PlayBannerBundle
    clearInterval(animatedLyrics_2);
    clearInterval(currentProgressBar);
    clearInterval(asignarValores); // CommentVideoBundle
    clearInterval(deslize_to_left_interval);
    clearInterval(deslize_to_right_interval);
    
    e_palabras = 0; // contador de palabras para el karaoke
    d_estrofas = 0; // contador de palabras para el karaoke
    
    // about commentBundle
    for (var i=0; i<40; i++)
    {
        commentsGroup[i] = 0;
    }
    amount_commentsGroup = 0;
    
    // me genera los ciclos repetitivos para el video actual

    current_video_id = videoId;
    current_video_name = videoName;
    current_video_description = videoDescription;
    current_video_image = videoImage;
    current_video_content = videoContent;
    current_video_updateDate = videoUpdateDate;
    current_video_amount_views = videoAmountViews;
    current_video_amount_comments = videoAmountComments;
    current_video_likes = videoLikes;
    current_video_dislikes = videoDislikes;
    current_video_userId = userId;
    current_video_userName = userName;
    
//    muted='true'
    var my_video = document.getElementById("my_video_environment");
    my_video.innerHTML =
//        "<div id='my_video_background'>" +
//        "</div>" +
        "<video id='my_video' width='100%' muted='true' autoplay='true'>" +
        "<source src='files/videos/" + videoContent + "') }}' type='video/mp4'> " +
        "</video>";





    increaseAmountViews_crud(); // SongBundle 
    update_songInfo();// SongBundle.js
    playBannerProgress(); // PlayBannerBundle
    get_video_lyric(); // ShowLyricsBundle - Karaoke
    showCurrentTime_withFormat(); // PlayBannerBundle
    changeVideoSpeed(); // PlayBannerBundle
    showDuration(); // PlayBannerBundle
    updateArtistInfo(); // ArtistBundle
    animarComentarios(); // CommentVideoBundle
    getArtistInfo(); // PaypalBundle
    
    
    
}

window.onload = loadWindowAreafunctions();
function loadWindowAreafunctions()
{
    sessionArea_width = 180; 
    configurationArea_width = 180; 
    configurationArea_right = 360;
    searchBar_width = 180;
    
    var presentationArea = document.getElementById('presentationArea');
    presentationArea.style.transitionProperty = "all";
    presentationArea.style.transitionDuration = 0.5 + "s";
    presentationArea.style.width = $(window).width() - 180 + "px";

    var sessionArea = document.getElementById('sessionArea');
    sessionArea.style.transitionProperty = "all";
    sessionArea.style.transitionDuration = 0.5 + "s";
    sessionArea.style.width = sessionArea_width + "px";

    var configurationArea = document.getElementById('configurationArea');
    configurationArea.style.transitionProperty = "all";
    configurationArea.style.transitionDuration = 0.5 + "s"; 
    configurationArea.style.width = configurationArea_width + "px";
    configurationArea.style.right = configurationArea_right + "px";

    videoSize = "2";        
}


function highlightPortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 1;
}

function hidePortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 0.4;
}

    
function configureLyricswordTimeWithFormat(time) {
    var minutes = parseInt(time / 60, 10);
    var seconds = time % 60;
    var minutesString = "";
    var secondsString = "";

    if (minutes<=9)
    {
        minutesString = "0"+minutes;
    }
    else
    {
        minutesString = ""+minutes;
    }

    if (seconds<=9)
    {
        secondsString = "0"+seconds;
    }
    else
    {
        secondsString = ""+seconds;
    }

    var newValue = minutesString + ":" + secondsString.substring(0, 2);
    return newValue;
}

function showMessage_EmergentWindow(message)
{
        var respectlyFormId = document.getElementById("emergentWindow");

        respectlyFormId.style.width = "100%";
        respectlyFormId.style.height = "100%";
        respectlyFormId.style.opacity = "0.9";
        respectlyFormId.style.zIndex = "20";
        respectlyFormId.style.position = "absolute";
        respectlyFormId.style.color = "gray";
        respectlyFormId.style.backgroundColor = "white";
        respectlyFormId.style.overflowY = "scroll";
        
        respectlyFormId.innerHTML = 
        "<center>"+
        "<br><br><br><br><br><br>"+
        "<table width='300px' border='0'>"+
        
            "<tr>"+
                "<td colspan='2' align='right'>"+
                "<div id='close_EmergentWindow' style='cursor:pointer; background-color:red; padding:5px; opacity: 0.5; color: white; width:40px; height:30px;'><center>X</center></div>"+
                "</td>"+
            "</tr>"+

            "<tr>"+
                "<td>"+
                    "<br>"+message+"<br><br>"+
                "</td>"+
            "</tr>"+

            "<tr height='40px'>"+
                "<td colspan='2'>"+
                
                "<center>"+
                    "<div id='accept_EmergentWindow' style='cursor:pointer; background-color:#1ab7ea; padding:5px; opacity: 0.5; width:60px; height:30px;'>"+
                    "ACCEPT"+
                    "</div>"+
                "</center>"+

                
                "</td>"+
            "</tr>"+
            
        "</table>"+
        
        "</center>";
                
        $('#close_EmergentWindow').click(function () {
        var respectlyFormId = document.getElementById("emergentWindow");

            respectlyFormId.style.width = "100%";
            respectlyFormId.style.height = "100%";
            respectlyFormId.style.opacity = "0";
            respectlyFormId.style.zIndex = "1";
            respectlyFormId.style.position = "absolute";

            respectlyFormId.innerHTML = "";
        });
        
                
        $('#accept_EmergentWindow').click(function () {
        var respectlyFormId = document.getElementById("emergentWindow");

            respectlyFormId.style.width = "100%";
            respectlyFormId.style.height = "100%";
            respectlyFormId.style.opacity = "0";
            respectlyFormId.style.zIndex = "1";
            respectlyFormId.style.position = "absolute";

            respectlyFormId.innerHTML = "";
        });
        
}

function solo_numeros(e)
{

    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo código: keyCode
    letras = " 1234567890";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ñ

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }

    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}

function solo_letras(e)
{
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo código: keyCode
    letras = "abcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ñ

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }

    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}

function solo_letras_numeros(e)
{
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo código: keyCode
    letras = " 1234567890abcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ñ

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }

    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}