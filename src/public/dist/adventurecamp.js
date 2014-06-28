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
angular.module('adventurecamp').
                    factory('adminSvc', ['$http', '$q',
                        function($http, $q) {
                            return {
                                getController: function(){
                                    var deferred = $q.defer();
                                    $http.get({
                                        method: 'GET',
                                        url: '/api/home.json'
                                    }).then(function(res) {
                                        deferred.resolve(res);
                                    }, function(res) {
                                        deferred.reject(res);
                                    });
                                    return deferred.promise;
                                },
                                view: function(id) {
                                    var deferred = $q.defer();

                                    $http.get({
                                        method: 'GET',
                                        url: '/api/registration/' + id
                                    }).then(function(res) {
                                        deferred.resolve(res);
                                    }, function(res) {
                                        deferred.reject(res);
                                    });
                                    return deferred.promise;
                                },
                                find: function(skip, take) {
                                    var deferred = $q.defer();

                                    $http.get({
                                        method: 'GET',
                                        url: '/ai/registration'
                                    }).then(function(res) {
                                        deferred.resolve(res);
                                    }, function(res) {
                                        deferred.reject(res);
                                    });

                                    return deferred.promise;
                                }
                            }
                        }]).
                    controller('adminCtrl', [function(){
                        $scope.confirm = function(){

                        };

                        $scope.view = function(){

                        };
                    }])
angular.module('adventurecamp').
                    controller('homeCtrl', ['$scope',
                        function($scope) {
                          
                          
                        }]);
angular.
        module('adventurecamp').
        controller('overviewCtrl', [function(){
                
        }]);
angular.
        module('adventurecamp').
        service('signupSvc', ['$rootScope', function($rootScope) {
                var opened = true;
                
                return {
                    isOpen: function(){
                        return opened;
                    },
                    open: function(){
                        opened = true;
                    },
                    close: function(){
                        opened = false;
                    },
                    submit: function(){
                        
                    }
                };
        }]).
        directive('aaSignup', ['signupSvc', function(signupSvc) {
                return {
                    templateUrl: '/html/signup.html',
                    link: function(scope, element, attribute){
                        scope.close = signupSvc.close();
                    }
                }
        }]);
angular.
        module('adventurecamp').
        controller('temsCtrl', [function(){
                
        }]);
angular.
        module('adventurecamp').
        controller('wordCtrl', [function(){
                
        }]);