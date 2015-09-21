var app = angular.module('App', ['admin']);

//Config do App
app.config(function ($httpProvider) {
	//Altera o content type do header, para enviar dados no tipo request ao invés de json para o servidor
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

	//Serialize os dados igual jquery faz no post
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    }
});