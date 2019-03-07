function update_songInfo()
{
    var percentageLikes = parseInt((100 * current_video_likes)) / parseInt((current_video_likes + current_video_dislikes));
    var percentageDislikes = parseInt((100 * current_video_dislikes)) / parseInt((current_video_likes + current_video_dislikes));
    
    document.getElementById("videoUpdatedate").innerHTML = current_video_updateDate;
    document.getElementById("videoAmountViews").innerHTML = current_video_amount_views + " views";
    document.getElementById("videoAmountComments").innerHTML = current_video_amount_comments + " comments";
    document.getElementById("videoPunctuation").innerHTML = 
            " <div style='height: 5px; width: 100%;'>"
                +"<div style='display: inline-block; height: 5px; width: "+percentageLikes+"%; background-color: blue; '></div>"
                +"<div style='display: inline-block; height: 5px; width: "+percentageDislikes+"%; background-color: red; '></div>"
            +" </div>";
    
    document.getElementById("songIconButton").innerHTML = current_video_name;
    document.getElementById("artistIconButton").innerHTML = current_video_userName;
}