adminModule.factory('apartamentoModel', ['$http', function($http)
{
	var urlBase = '/admin/api/apartamento';
	var apartamento = {};

	apartamento.getAll = function()
	{
		return $http.get(urlBase);
	};

	return apartamento;
}]);