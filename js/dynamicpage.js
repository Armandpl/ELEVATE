$(function() {

    $(document).ready(function() {
        if(location.pathname.indexOf(".php") >= 0) // fonctionne parce que indexOf retourne -1 s'il a rien trouvé
        {//Si l'url contient .php, on enlève .php
            history.pushState(null, null, location.pathname.replace(/\.[^/.]+$/, ""));    
        }
        if(location.pathname.indexOf(".php") == -1 && location.pathname.length>1)//si l'url contient pas .php et contient un nom de page on charge la bonne page en rajoutant .php
        {
            loadContent(location.pathname+".php");
        }
        else if(location.pathname.length <= 1)//si l'url contient pas de nom de page on load home.php
        {
            var url = "home.php"; //page à loader
            loadContent(url);//on load la page
            history.pushState(null, null, url.replace(/\.[^/.]+$/, ""));//on modifie l'url pour afficher le nom de la page
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
        loadContent(_link);
        return false;
    });

    function loadContent(href){
        $mainContent
                .find("#guts")
                .fadeOut(200, function() {
                    $mainContent.hide().load(href + " #guts", function(responseText, statusText, xhr) {
                        if(statusText=="success"){
                            $mainContent.fadeIn(200, function() {
                                $pageWrap.animate({
                                    height: baseHeight + $mainContent.height() + "px"
                                });
                            });
                            $("nav a").removeClass("current");
                            console.log(href);
                            $("nav a[href$='"+href+"']").addClass("current");
                        }
                        else{//Si il y a une erreur quand on load la page demandée
                            var url = "home.php"; //page à loader
                            loadContent(url);//on load la page
                            history.pushState(null, null, url.replace(/\.[^/.]+$/, ""));//on modifie l'url pour afficher le nom de la page

                        }    

                    });
                });     
    }
    
    $(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
       loadContent(_link+".php");
    });

} // otherwise, history is not supported, so nothing fancy here.
});