/**
 * @ngdoc module
 * @name Adventure Camp module
 * @author Guilherme Cardoso <email@guilhermecardoso.pt>
 * 
 * @description
 * I'm releasing this website with Apache2 license
 * Feel free to use it and may God bless you!
 */
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "http://connect.facebook.net/pt_PT/sdk.js#xfbml=1&appId=256560181215554&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
angular.
        module('adventurecamp', ['ui.router', 'pascalprecht.translate', 'bs-validation', 'ngAnimate', 'ui.bootstrap.datetimepicker', 'ui.bootstrap', 'ui.bootstrap.modal']).
        config(['$stateProvider', '$urlRouterProvider', '$translateProvider', '$translatePartialLoaderProvider', '$locationProvider',
            function($stateProvider, $urlRouterProvider, $translateProvider, $translatePartialLoaderProvider, $locationProvider) {
                $urlRouterProvider.otherwise('/home');
                $locationProvider.html5Mode(true);

                $stateProvider.
                        state('home', {
                            url: '/home',
                            templateUrl: '/html/home.html',
                            controller: 'homeCtrl'
                        }).
                        state('overview', {
                            url: '/overview',
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
                        });

                $translateProvider.useLoader('$translatePartialLoader', {
                    urlTemplate: '/i18n/{lang}/{part}.json'
                });

                $translateProvider.preferredLanguage('en_US');
                $translatePartialLoaderProvider.addPart('signup');
            }]).
        run(['$rootScope', 'signupSvc',
            function($rootScope, signupSvc) {
                $rootScope.openSignup = function(){
                    signupSvc.open();
                }
                $rootScope.signupOpen = true;
                $rootScope.changeLocale = function(locale) {

                };
            }]);