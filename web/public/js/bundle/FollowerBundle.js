function closeProfileFollower()
{
    var profileFollower = document.getElementById("profileFollower");
    profileFollower.style.height = "0px";
    profileFollower.style.top = "50px";
}

function showProfileFollower()
{
    var profileFollower = document.getElementById("profileFollower");
    profileFollower.style.height = "100px";
    profileFollower.style.top = "50px";
}

function closeListFollowers()
{
    var listFollowers = document.getElementById("listFollowers");
    listFollowers.style.top = "0px";
    listFollowers.style.bottom = "0px";
}

function showListFollowers_both()
{
    var listFollowers = document.getElementById("listFollowers");
    listFollowers.style.top = "100px";
    listFollowers.style.bottom = "100px";
}

function showListFollowers_top()
{
    var listFollowers = document.getElementById("listFollowers");
    listFollowers.style.top = "100px";
    listFollowers.style.bottom = "0px";
}

function showListFollowers_bottom()
{
    var listFollowers = document.getElementById("listFollowers");
    listFollowers.style.top = "0px";
    listFollowers.style.bottom = "100px";
}

function closeReportFollowers()
{
    var reportFollowers = document.getElementById("reportFollowers");
    reportFollowers.style.height = "0px";
    reportFollowers.style.bottom = "100px";
}

function showReportFollowers()
{
    var reportFollowers = document.getElementById("reportFollowers");
    reportFollowers.style.height = "100px";
    reportFollowers.style.bottom = "100px";
}