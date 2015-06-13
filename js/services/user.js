angular
	.module('TheApp')
	.service('UserService', UserService);

function UserService($http, API){
	var me = this;
	var entity = 'user';

	me.all = [];

	me.getAll = function(){
		var promise = $http({
			method: 'GET',
			url: API.BASE+'user',
			headers: API.HEADERS
		});
		promise.then( function(res){
			angular.copy( res.data, me.all );
		} );
		return promise;
	}
	me.get = function(id){
		var promise = $http({
			method: 'GET',
			url: API.BASE+'user/'+id,
			headers: API.HEADERS
		})
		return promise;
	}
	me.save = function(obj){
		var promise = $http({
			method: obj.id ? 'PUT' : 'POST',
			url: API.BASE+'user',
			headers: API.HEADERS,
			data: obj
		});
		promise.then( function(res){
			for(var i=0, u=me.all[i]; u = me.all[i]; i++){
				if( u.id === res.data.id ){ 
					angular.extend( u, res.data )
					return;
				}
			}
			me.all.push( res.data );
		});
		return promise;
	}
	me.delete = function(id){
		var promise = $http({
			method: 'DELETE',
			url: API.BASE+'user/'+id,
			headers: API.HEADERS
		});
		promise.then(function(res){
			for(var i=0, u=me.all[i]; u = me.all[i]; i++){
				if( u.id === id ){ 
					me.all.splice(i, 1) 
					return;
				}
			}
		})
		return promise;
	}
	me.recreate = function(){
		return $http({
			method: 'GET',
			url: API.RECREATE,
			headers: API.HEADERS
		});
	}
}