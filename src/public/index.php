<html ng-app="adventurecamp">
    <head>
        <title ng-bind="{{currentPage.title}}"></title>
        <link rel="stylesheet" type="text/css" href="dist/adventurecamp.css" />
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="bower_components/angular/angular.js"></script>
        <script type="text/javascript" src="bower_components/angular-ui-router/release/angular-ui-router.js"></script>
        <script type="text/javascript" src="bower_components/angular-translate/angular-translate.js"></script>
        <script type="text/javascript" src="bower_components/angular-bootstrap-validation/dist/angular-bootstrap-validation.js"></script>
        <script type="text/javascript" src="bower_components/angular-translate-loader-partial/angular-translate-loader-partial.js"></script>
        <script type="text/javascript" src="/dist/adventurecamp.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "http://connect.facebook.net/pt_PT/sdk.js#xfbml=1&appId=256560181215554&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
        <div class="container-fluid">
            <div class="aa-container">
                <div class="row" id="main">
                    <div class="aa-signup" ng-class="{'col-xs-7': signupOpen, 'col-xs-24': !signupOpen}">
                        <div aa-signup></div>
                    </div>
                    <div ng-class="{'col-xs-17': signupOpen, 'col-xs-24': !signupOpen}">
                            <div class="aa-navmenu-container">
                                    <ul class="aa-navmenu">
                                        <li><a ui-sref="home">Home</a></li>
                                        <li><a ui-sref="overview">Overview</a></li>
                                        <li><a ui-sref="terms">Terms</a></li>
                                        <li><a ui-sref="word">Word to Fathers</a></li>
                                </ul>
                        </div>
                        <div class="ui-view-container">
                            <div  ui-view ng-animate="'view'">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>