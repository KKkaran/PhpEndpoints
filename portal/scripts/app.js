(function () {
    'use strict';
    
    const app = angular.module("ng-app", []);
    app.controller("basicController", basicController)
    .controller("asyncController",asyncController)

    asyncController.$inject = ["$q"]
    function asyncController($q) {
        let as = this;
        as.result = 0;
        function add(a,b) {
            let q = $q.defer();
            setTimeout(() => {
                q.resolve(a+b)
            },100)
            return q.promise;
        }
        let st = Date.now()
        add(5, 7)
            .then(res => {
                as.result = res
                as.elapsed = Date.now() - st;
            })
        .catch(er=>console.log(er))
    }


    basicController.$inject = ["$http"]
    function basicController($http) {
        let bc = this;
        bc.name = ""
        bc.size = 0
        bc.is_available = ""
        bc.results = []
        $http.get("http://localhost/Php_Endpoint_REST/products")
            .then((res) => {
                console.log(res.data)
                bc.results = res.data})
        
        bc.addProduct = function() {
            bc.name && bc.is_available && add2DB($http);
        }
        function add2DB(http){
            http({
                method:'POST',
                url:'http://localhost/Php_Endpoint_REST/products',
                headers:{
                    "Content-Type":"application/json"
                },
                data: {
                    name: bc.name,
                    size: bc.size,
                    is_available: bc.is_available
                },
                transformResponse: [
                    function (data) { 
                        return data; 
                    }
                ]
            }).then(function(res){
                res.config.data = {...res.config.data,id:JSON.parse(res.data)["id"]}
                bc.results = [...bc.results, res.config.data]
            }).catch(err=>console.log(err))
        }
    }

})()