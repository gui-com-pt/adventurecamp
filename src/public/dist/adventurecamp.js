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
        service('signupSvc', ['$rootScope', '$http', '$q', '$modal', function($rootScope, $http, $q, $modal) {
                var s = {};
                var getModalText = function() {
                    return "<p>Obrigado por te teres juntado á nossa aventura!</p>" +
                            "<p>Estás preparado? Faltam 24 dias!</p>\n\
<p>Revê o que vais precisar: </p>";
                }

                s.opened = true;
                return {
                    isOpen: function() {
                        return s.opened;
                    },
                    open: function() {
                        $rootScope.signupOpen = true;
                    },
                    close: function() {
                        $rootScope.signupOpen = false;
                    },
                    submit: function(req) {
                        var deferred = $q.defer();

                        $http({method: 'POST', url: '/api/subscription', data: req}).
                                success(function(res) {
                                    $modal = $modal.open({
                                        templateUrl: 'signupSuccess.html',
                                        controller: ['$scope', '$modalInstance', '$sce', function($scope, $modalInstance, $sce) {
                                                $scope.body = $sce.trustAsHtml(getModalText());
                                                $scope.close = function() {
                                                    $modalInstance.dismiss();
                                                };
                                            }]
                                    });
                                    then(function(res) {
                                        $rootScope.signupOpen = false;
                                    });

                                }).
                                error(function(res) {
                                    deferred.reject(res);
                                });

                        return deferred.promise;
                    }
                };
            }]).
        directive('aaSignup', ['signupSvc', '$log', function(signupSvc, $log) {
                return {
                    templateUrl: '/html/signup.html',
                    controller: 'signupCtrl',
                    link: function(scope, element, attrs) {
                        scope.form = {};
                        scope.subscription = {
                            birthday: null,
                        };
                        
                        scope.close = function() {
                            signupSvc.close();
                        }
                        
                        scope.submit = function(){
                            if(scope.form.register.$invalid) {
                                return;
                            }
                            var req = {
                                name: scope.name,
                                birthday: scope.birthday,
                                contact: scope.contact,
                                email: scope.email,
                                address: scope.address,
                                cep: scope.cep
                            };
                            signupSvc.submit(req);
                        }
                    }
                }
            }]).
        controller('signupCtrl', ['$scope', '$log', 'signupSvc', '$rootScope', function($scope, $log, signupSvc, $rootScope) {
                $scope.close = function() {
                    signupSvc.close();
                    $rootScope.signupOpen = false;
                }
            }]);
angular.
        module('adventurecamp').
        controller('termsCtrl', [function(){
                
        }]);
angular.
        module('adventurecamp').
        controller('wordCtrl', [function(){
                
        }]);