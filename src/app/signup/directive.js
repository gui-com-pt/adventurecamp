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