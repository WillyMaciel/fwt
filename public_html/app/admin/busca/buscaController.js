adminModule.controller('buscaController', ['hotelModel', 'apartamentoModel', '$scope', '$log', function(hotelModel, apartamentoModel, $scope, $log)
{
	vm = this;

	vm.filter = '';
	vm.objectList = [];
	vm.selectedObjects = [];
	vm.checkboxClick = checkboxClick;
	vm.mergeSelectedWithListed = mergeSelectedWithListed;
	vm.objectListSelected = [];

	$scope.$watch('vm.model', function() {
       console.log(vm.model);
		switch(vm.model)
		{
			case vm.model = 'hotel':
			hotelModel.getAll().then(function(response)
			{
				vm.objectList = response.data;
				console.log(vm.objectList);

				vm.mergeSelectedWithListed(vm.objectListSelected);
			});
			break;
			case vm.model = 'apartamento':
			apartamentoModel.getAll().then(function(response)
			{
				vm.objectList = response.data;
				console.log(vm.objectList);

				vm.mergeSelectedWithListed(vm.objectListSelected);
			});
			break;
		}

   	});

	// hotelModel.getAll().then(function(response)
	// {
	// 	vm.objectList = response.data;

	// 	vm.mergeSelectedWithListed(vm.objectListSelected);
	// });

	function checkboxClick(object)
	{
		//Se o objeto ja foi marcado, desmarcar
		for (var i = vm.selectedObjects.length - 1; i >= 0; i--) 
		{
			if(vm.selectedObjects[i] === object)
			{
				object.selected = false;
				vm.selectedObjects.splice(i, 1);
				//vm.objectList.push(object);
				return;
			}					
		}

		for (var i = vm.objectList.length - 1; i >= 0; i--) 
		{
			if(vm.objectList[i] === object)
			{
				object.selected = true;
				//vm.objectList.splice(i, 1);
				vm.selectedObjects.push(object);
				return;
			}
		}
		
	}

	function mergeSelectedWithListed(collection)
	{
		for (var i = vm.objectList.length - 1; i >= 0; i--) 
		{
			for (var i2 = collection.length - 1; i2 >= 0; i2--) 
			{
				if(vm.objectList[i].id == collection[i2].id)
				{
					vm.objectList[i].selected = true;
					vm.selectedObjects.push(vm.objectList[i]);
				}
			}
		}
	}


}]);