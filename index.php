<!DOCTYPE html>
<html land="sv">

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="style/index.css">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).mousedown(function(event) {
                var objTarget = event.target.id;
                if (event.target.nodeName == "ARTICLE" || event.target.id == "articleContainer") {
                    objTarget = "articleContainer";
                    $("#articleContainer").css({height:'400px'});
                    $("#articleContainer").css({width:'400px'});
                }
                else if (event.target.nodeName == "HEADER") {
                    $("#"+objTarget).css({height:'50px'});
                }
                else {
                    $("#"+objTarget).css({height:'300px'});
                    $("#"+objTarget).css({width:'150px'});
                }
                var interval = setInterval(function() {
                    var height = $("#"+objTarget).height();
                    var width = $("#"+objTarget).width();
                    if (event.target.nodeName != "HEADER") {
                        if (event.target.nodeName == "ARTICLE" || event.target.id == "articleContainer") {
                            $("#articleContainerhead").text("Current height is " + height + "px and width is " + width + "px");
                        }
                        else {
                            $("#"+objTarget).text("Current height is " + height + "px and width is " + width + "px");
                        }
                    }
                    else {
                        $("#"+objTarget).text("Current height is " + height + "px");
                    }
                }, 10);
                $(document).mouseup(function() {
                    clearInterval(interval);
                    //var height = header.height();
                    var objH = $("#"+objTarget).height();
                    var objW = $("#"+objTarget).width();
                    var obj = {objTarget: objTarget, objH: objH, objW: objW};
                    $.ajax({
                        url: 'test.php',
                        type: 'post',
                        data: {
                            obj: JSON.stringify(obj)
                        },
                        success: function() {
                            if (event.target.nodeName != "HEADER") {
                                if (event.target.nodeName == "ARTICLE" || event.target.id == "articleContainer") {
                                    $("#articleContainerhead").text("New height is set to " + objH + "px and width to " + objW + "px");
                                }
                                else {
                                    $("#"+objTarget).text("New height is set to " + objH + "px and width is to " + objW + "px");
                                }
                            }
                            else {
                                $("#"+objTarget).text("New height is set to " + objH + "px");
                            }
                        }

                    });
                });
            });
        });
    </script>
    <script>

    </script>
</head>

<body>
    <?php

        session_start();
        if(!isset($_SESSION['height'])) {
        }
        echo "
        <div id='headerContainer'>
            <header id='headerLeft' style='height: {$_SESSION['headerLeft']['H']}px'>Left headers height is {$_SESSION['headerLeft']['H']}px</header>

            <header id='headerMiddle' style='height: {$_SESSION['headerMiddle']['H']}px'>Middle headers height is {$_SESSION['headerMiddle']['H']}px</header>

            <header id='headerRight' style='height: {$_SESSION['headerRight']['H']}px'>Right headers height is {$_SESSION['headerRight']['H']}px</header>
        </div>


        <main>
            <aside id='asideLeft' style='height: {$_SESSION['asideLeft']['H']}px; width: {$_SESSION['asideLeft']['W']}px;'>Left asides height is {$_SESSION['asideLeft']['H']}px and width is {$_SESSION['asideLeft']['W']}px</aside>

            <div id='articleContainer' style='height: {$_SESSION['articleContainer']['H']}px; width: {$_SESSION['articleContainer']['W']}px;'>

                <p id='articleContainerhead'>Article containers height is {$_SESSION['articleContainer']['H']}px and width is {$_SESSION['articleContainer']['W']}px</p>

                <article id='articleTop' style='height: ; width: ;'>Article top</article>

                <article id='articleMiddle' style='height: ; width: ;'>Article middle</article>

                <article id='articleBottom' style='height: ; width: ;'>Article bottom</article>

            </div>

            <aside id='asideRight' style='height: {$_SESSION['asideRight']['H']}px; width: {$_SESSION['asideRight']['W']}px;'>Right asides height is {$_SESSION['asideRight']['H']}px and width is {$_SESSION['asideRight']['W']}px</aside>
        </main>
        ";

   ?>

        <footer>Footer</footer>
</body>

</html>
