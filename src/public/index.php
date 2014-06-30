<html ng-app="adventurecamp">
    <head>
        <title ng-bind="{{currentPage.title}}"></title>
        <link rel="stylesheet" type="text/css" href="dist/adventurecamp.css" />
        <script type="text/javascript" src="bower_components/moment/moment.js"></script>
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="bower_components/angular/angular.js"></script>
        <script type="text/javascript" src="bower_components/angular-ui-router/release/angular-ui-router.js"></script>
        <script type="text/javascript" src="bower_components/angular-translate/angular-translate.js"></script>
        <script type="text/javascript" src="bower_components/angular-bootstrap-validation/dist/angular-bootstrap-validation.js"></script>
        <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
        <script type="text/javascript" src="bower_components/angular-animate/angular-animate.js"></script>
        <script type="text/javascript" src="bower_components/angular-translate-loader-partial/angular-translate-loader-partial.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="bower_components/angular-bootstrap-datetimepicker/src/js/datetimepicker.js"></script>        
        <link rel="stylesheet" type="text/css" href="bower_components/angular-bootstrap-datetimepicker/src/css/datetimepicker.css" />
        <script type="text/javascript" src="/dist/adventurecamp.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="container-fluid">
            <div class="aa-container">
                <div class="row" id="main">
                    <div class="aa-signup" ng-class="{'col-xs-7': signupOpen, 'hidden sidebar-closed': !signupOpen}">
                        <div aa-signup></div>
                    </div>
                    <div ng-class="{'col-xs-17': signupOpen, 'col-xs-24': !signupOpen}">
                            <div class="aa-navmenu-container">
                                <a class="btn-signup" ng-click="openSignup()" ng-if="!signupOpen">Inscreve-te!</a>
                                    <ul class="aa-navmenu">
                                        <li><a ui-sref="home">Home</a></li>
                                        <li><a ui-sref="overview">Overview</a></li>
                                        <li><a ui-sref="terms">Terms</a></li>
                                        <li><a ui-sref="word">Word to Fathers</a></li>
                                </ul>
                        </div>
                        <div class="ui-view-container">
                            <!--<div  ui-view ng-animate="'view'"></div>-->
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="modal"
        <script type="text/ng-template" id="signupSuccess.html">
              <div class="modal-header">
            <h3>Bem vindo a esta aventura!</h3>
            </div>
            <div class="modal-body">
            {{body}}
            </div>
            <div class="modal-footer">
            <button class="btn btn-primary" ng-click="close()">Fechar</button>
            </div>   
            </script>
    </body>
</html>