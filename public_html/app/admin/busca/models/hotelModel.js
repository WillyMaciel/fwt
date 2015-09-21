adminModule.factory('hotelModel', ['$http', function($http)
{
	var urlBase = '/admin/api/hotel';
	var hotel = {};

	hotel.getAll = function()
	{
		return $http.get(urlBase);
	};

	return hotel;
}]);