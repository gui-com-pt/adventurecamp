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