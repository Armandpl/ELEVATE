$(function() {

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