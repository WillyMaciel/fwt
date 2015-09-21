adminModule.directive('buscaDirective', function() 
{
  return{
  	restrict: 'E',
  	scope: {model: '@scopeModel', objectListSelected: '@scopeObjectListSelected'},
  	controller: 'buscaController',
  	controllerAs: 'buscaCtrl',
  	bindToController: true,
    templateUrl: 'app/admin/busca/directives/buscaDirectiveTemplate.html'
  }
});