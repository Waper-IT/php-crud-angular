angular
	.module('TheApp')
	.controller('MainCtrl', MainCtrl);

function MainCtrl(UserService, $timeout){
	var me = this;
	
	//exposes
	me.rows = UserService.all;
	me.editing = null;
	me.loading = false;
	me.edit = editUser;
	me.delete = deleteUser;
	me.save = saveUser;
	me.init = true;
	me.error = false;
	me.recreate = recreate;
	me.getAll = getAll;

	function editUser(obj){
		me.editing = obj ? angular.copy(obj) : {};
	}
	function saveUser(obj){
		me.editing = null;
		me.loading = true;
		UserService
			.save(obj)
			.success(getOk)
			.catch( apiError );
	}
	function deleteUser(obj){
		me.loading = true;
		UserService
			.delete(obj.id)
			.success(getOk)
			.catch( apiError );	
	}

	function getAll(){
		me.loading = true;
		UserService
			.getAll()
			.success( getOk )
			.catch( apiError );	
	}	
	function recreate(){
		UserService
			.recreate()
			.success( function(){
				if( confirm('volver a buscar todos?') ) me.getAll();
			})
	}

	function getOk(response){
		me.loading = false;
	}
	function apiError(error){
		me.loading = false;
		me.error = error;
		$timeout( cleanError, 2000 );
	}
	function cleanError(){
		me.error = false;
	}

	getAll();
};