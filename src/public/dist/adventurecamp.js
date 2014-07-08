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
        controller('overviewCtrl', ['$scope', function($scope) {
                $scope.map = {
                    center: {
                        latitude: 40.667007, 
                        longitude: -7.951528
                    },
                    zoom: 14
                };
                $scope.mapOptions = {
                    mapTypeId: google.maps.MapTypeId.HYBRID
                            //,styles: [{"featureType":"landscape.natural.landcover","stylers":[{"gamma":0.44},{"hue":"#2bff00"}]},{"featureType":"water","stylers":[{"hue":"#00a1ff"},{"saturation":29},{"gamma":0.74}]},{"featureType":"landscape.natural.terrain","stylers":[{"hue":"#00ff00"},{"saturation":54},{"lightness":-51},{"gamma":0.4}]},{"featureType":"transit.line","stylers":[{"gamma":0.27},{"hue":"#0077ff"},{"saturation":-91},{"lightness":36}]},{"featureType":"landscape.man_made","stylers":[{"saturation":10},{"lightness":-23},{"hue":"#0099ff"},{"gamma":0.71}]},{"featureType":"poi.business","stylers":[{"hue":"#0055ff"},{"saturation":9},{"lightness":-46},{"gamma":1.05}]},{"featureType":"administrative.country","stylers":[{"gamma":0.99}]},{"featureType":"administrative.province","stylers":[{"lightness":36},{"saturation":-54},{"gamma":0.76}]},{"featureType":"administrative.locality","stylers":[{"lightness":33},{"saturation":-61},{"gamma":1.21}]},{"featureType":"administrative.neighborhood","stylers":[{"hue":"#ff0000"},{"gamma":2.44}]},{"featureType":"road.highway.controlled_access","stylers":[{"hue":"#ff0000"},{"lightness":67},{"saturation":-40}]},{"featureType":"road.arterial","stylers":[{"hue":"#ff6600"},{"saturation":52},{"gamma":0.64}]},{"featureType":"road.local","stylers":[{"hue":"#006eff"},{"gamma":0.46},{"saturation":-3},{"lightness":-10}]},{"featureType":"transit.line","stylers":[{"hue":"#0077ff"},{"saturation":-46},{"gamma":0.58}]},{"featureType":"transit.station","stylers":[{"gamma":0.8}]},{"featureType":"transit.station.rail","stylers":[{"hue":"#ff0000"},{"saturation":-45},{"gamma":0.9}]},{"elementType":"labels.text.fill","stylers":[{"gamma":0.58}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"gamma":2.01},{"hue":"#00ffff"},{"lightness":22}]},{"featureType":"transit","stylers":[{"saturation":-87},{"lightness":44},{"gamma":1.98},{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"gamma":0.06},{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"hue":"#00aaff"},{"lightness":-6},{"gamma":2.21}]},{"elementType":"labels.text.stroke","stylers":[{"gamma":3.84}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"gamma":9.99}]},{"featureType":"administrative","stylers":[{"gamma":0.01}]}]
                };
                $scope.viewMap = false;

                $scope.markerA = {
                    latlng: {
                        latitude: 40.668395,
                        longitude: -7.979854
                    },
                    content: "Quinta do Ferronhe"
                };
            }]);

angular.
        module('adventurecamp').
        service('signupSvc', ['$rootScope', '$http', '$q', '$modal', function($rootScope, $http, $q, $modal) {
                var s = {};
                var getModalText = function() {
                    return '<p>Obrigado por te teres juntado á nossa aventura!</p>' +
                            '<p>Enviámos-te um email com os dados necessários para o pagamento por transferência.</p>' +
                            '<p>Caso tenhas dúvidas adicionais, não hesites em contactar-nos através do mail: <a href="mailto:acampamento.aventura.viseu@gmail.com">acampamento.aventura.viseu@gmail.com</a></p>';
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
                        
                        scope.confirmModal = function(){
                            signupSvc.openConfirmModal();
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
angular.module('adventurecamp').
    controller('signupConfirmCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.form = {};
      $scope.submit = function(){
        $scope.submitMsgShow = false;
                                    var req = {
                                        when: $scope.when,
                                        tranNumb: $scope.tranNumb,
                                        ammount: $scope.ammount,
                                        obs: $scope.obs,
                                        name: $scope.name
                                    };
                                    $http({
                                         url: '/api/subscription/confirm', 
                                         method: 'POST',
                                        data: req,
                                        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}}).
                                        success(function(res) {
                                            $scope.submitMsg = 'Obrigado pela tua confirmação :)'
                                            $scope.submitMsgShow  = true;
                                        }).error(function(res) {
                                            $scope.submitMsg = 'Ocorreu um error, por favor tenta de novo.';
                                            $scope.submitMsgShow  = true;
                                        });
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