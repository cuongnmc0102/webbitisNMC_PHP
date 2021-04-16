//croll menu
window.onscroll = function(){
    console.info(document.documentElement.scrollTop);
    var header = document.getElementById("sticky");

    if(document.documentElement.scrollTop > 100 || document.body.scrollTop > 100){
        header.style.position = "fixed";
        header.style.left = 0;
        header.style.right =0;
        header.style.backgroundColor = "rgb(118, 95, 231)";
        header.style.zIndex = 9;
    }else{
        header.style.position = "relative";
        header.style.backgroundColor = "rgb(238, 215, 177)";
    }
}
