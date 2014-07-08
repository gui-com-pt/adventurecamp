/**
 * @ngdoc module
 * @name Adventure Camp module
 * @author Guilherme Cardoso <email@guilhermecardoso.pt>
 * 
 * @description
 * I'm releasing this website with Apache2 license
 * Feel free to use it and may God bless you!
 */
       $(function() {

 (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "http://connect.facebook.net/pt_PT/sdk.js#xfbml=1&appId=256560181215554&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
 moment.lang('pt');
});
angular.
        module('adventurecamp', ['ui.router', 'pascalprecht.translate', 'bs-validation', 'ngAnimate', 'ui.bootstrap.datetimepicker', 'ui.bootstrap', 'ui.bootstrap.modal', 'google-maps']).
        config(['$stateProvider', '$urlRouterProvider', '$translateProvider', '$translatePartialLoaderProvider', '$locationProvider',
            function($stateProvider, $urlRouterProvider, $translateProvider, $translatePartialLoaderProvider, $locationProvider) {
                $urlRouterProvider.otherwise('/overview');
                $locationProvider.html5Mode(true);

                $stateProvider.
                        state('home', {
                            url: '/home',
                            templateUrl: '/html/home.html',
                            controller: 'homeCtrl'
                        }).
                        state('signupConfirm', {
                            url: '/confirm',
                            templateUrl: '/html/signupConfirm.html',
                            controller: 'signupConfirmCtrl'
                        }).
                        state('overview', {
                            url: '/',
                            templateUrl: '/html/overview.html',
                            controller: 'overviewCtrl'
                        }).
                        state('terms', {
                            url: '/terms-and-responsabilities',
                            templateUrl: '/html/terms.html',
                            controller: 'termsCtrl'
                        }).
                        state('word', {
                            url: '/a-word-to-parents',
                            templateUrl: '/html/word.html',
                            controller: 'wordCtrl'
                        }).state('admin', {
                            url: '/admin',
                            templateUrl: '/html/admin.html',
                            controller: 'adminCtrl'
                        });

                $translateProvider.useLoader('$translatePartialLoader', {
                    urlTemplate: '/i18n/{lang}/{part}.json'
                });

                $translateProvider.preferredLanguage('pt_PT');
                $translatePartialLoaderProvider.addPart('signup');
            }]).
        run(['$rootScope', 'signupSvc',
            function($rootScope, signupSvc) {

                /*
                 * I've also included some pages in this site, but it wasn't necessary
                 * I'll just hide them */
                $rootScope.showSite = true;
                $rootScope.isAdmin = false;
                $rootScope.openSignup = function(){
                    signupSvc.open();
                }
                $rootScope.signupOpen = true;
                $rootScope.changeLocale = function(locale) {

                };
            }]);