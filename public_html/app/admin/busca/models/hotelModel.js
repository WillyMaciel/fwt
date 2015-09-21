adminModule.factory('hotelModel', ['$http', function($http)
{
	var urlBase = '/admin/api/hotel';
	var hotel = {};

	hotel.getAll = function()
	{
		return $http.get(urlBase);
	};

	hotel.getOfPacote = function(id)
	{

	}

	return hotel;
}]);