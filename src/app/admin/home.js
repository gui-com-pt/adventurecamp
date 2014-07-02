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