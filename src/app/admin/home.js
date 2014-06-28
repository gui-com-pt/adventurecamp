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