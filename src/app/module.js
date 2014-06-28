/**
 * @ngdoc module
 * @name Adventure Camp module
 * @author Guilherme Cardoso <email@guilhermecardoso.pt>
 * 
 * @description
 * I'm releasing this website with Apache2 license
 * Feel free to use it and may God bless you!
 */
angular.
        module('adventurecamp', ['ui.router', 'pascalprecht.translate']).
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
                $rootScope.signupOpen = signupSvc.isOpen();
                $rootScope.changeLocale = function(locale) {

                };
            }]);