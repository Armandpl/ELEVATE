$(function() {

    $(document).ready(function() {
    if(location.pathname.indexOf(".php") >= 0) // fonction parce que indexOf retourne -1 s'il a rien trouvé
    {//Si l'url contient .php, on enlève .php
        history.pushState(null, null, location.pathname.replace(/^.*[\\\/]/, ''));       
    }
    else if(location.pathname.length>1)//si l'url contient pas .php on charge la bonne page en rajoutant .php
    {
        loadContent(location.pathname+".php");
    }
    });

    if (window.history && window.history.pushState){
    var newHash      = "",
        $mainContent = $("#main_content"),
        $pageWrap    = $("#wrap"),
        baseHeight   = 0,
        $el;
        
    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();
    
    $("nav").delegate("a", "click", function() {
        _link = $(this).attr("href");
        history.pushState(null, null, _link.replace(/\.[^/.]+$/, ""));
        loadContent(_link)+".php";
        return false;
    });

    function loadContent(href){
        $mainContent
                .find("#guts")
                .fadeOut(200, function() {
                    $mainContent.hide().load(href + " #guts", function() {
                        $mainContent.fadeIn(200, function() {
                            $pageWrap.animate({
                                height: baseHeight + $mainContent.height() + "px"
                            });
                        });
                        $("nav a").removeClass("current");
                        console.log(href);
                        $("nav a[href$='"+href+"']").addClass("current");
                    });
                });     
    }
    
    $(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
       loadContent(_link+".php");
    });

} // otherwise, history is not supported, so nothing fancy here.
});