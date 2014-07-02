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
angular.module('adventurecamp').
                    factory('adminSvc', ['$http', '$q',
                        function($http, $q) {
                            return {
                                getController: function(){
                                    var deferred = $q.defer();
                                    $http({
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

                                    $http({
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

                                    $http({
                                        url: '/api/subscription',
                                        method: 'GET'
                                    }).success(function(res) {
                                        deferred.resolve(res);
                                    }).error(function(res) {
                                        deferred.reject(res);
                                    });

                                    return deferred.promise;
                                }
                            }
                        }]).
                    controller('adminCtrl', ['adminSvc', '$scope', function(svc, $scope){
                        $scope.subscriptions = [];
                        svc.find(0, 200).then(function(res) {
                            $scope.subscriptions = res.subscriptions;
                        })
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
        controller('overviewCtrl', ['$scope', function($scope){
                $scope.map = {
    center: {
        latitude: 40.657122,
        longitude: -7.974762
    },
    zoom: 13
};
	$scope.mapOptions = {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]
	};
	$scope.viewMap = false;

	$scope.markerA = {
		latlng: {
		latitude: 40.654485, 
		longitude: -7.988495
	},
	content: "Quinta do Ferronhe"
	};
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

                        $http({method: 'POST', 
                            url: '/api/subscription', 
                            data: req,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}}).
                                success(function(res) {
                                    var instance = $modal.open({
                                        templateUrl: 'signupSuccess.html',
                                        controller: ['$scope', '$modalInstance', '$sce', function($scope, $modalInstance, $sce) {
                                                $scope.body = $sce.trustAsHtml(getModalText());
                                                $scope.close = function() {
                                                    $modalInstance.close();
                                                };
                                            }]
                                    });
                                    instance.result.then(function(res) {
                                        $rootScope.signupOpen = false; // close the signup form after a sucefully signup
                                        deferred.resolve();
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
                 
                        scope.subscription = {
                            birthday: null,
                        };
                        
                        scope.close = function() {
                            signupSvc.close();
                        }
                        
                        scope.submit = function(){
                        
                            var req = {
                                name: scope.name,
                                birthday: scope.birthday,
                                contact: scope.contact,
                                email: scope.email,
                                address: scope.address,
                                cep: scope.cep,
                                bi: scope.bi,
                                observations: scope.observations
                            };
                            signupSvc.submit(req).then(function() {
                                scope.name = '';
                                scope.birthday = '';
                                scope.contact = '';
                                scope.email = '';
                                scope.address = '';
                                scope.cep = '';
                                scope.bi = '';
                                scope.observations = '';
                            });
                        }
                    }
                }
            }]).
        controller('signupCtrl', ['$scope', '$log', 'signupSvc', '$rootScope', function($scope, $log, signupSvc, $rootScope) {
                $scope.close = function() {
                    signupSvc.close();
                    $rootScope.signupOpen = false;
                };
            }]);
angular.
        module('adventurecamp').
        controller('termsCtrl', [function(){
                
        }]);
angular.
        module('adventurecamp').
        controller('wordCtrl', [function(){
                
        }]);