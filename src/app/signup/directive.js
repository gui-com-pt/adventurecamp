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