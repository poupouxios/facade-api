## Facade API

This package is responsible to simplify the calls to the API by hiding the complexity.

## Laravel Usage

* Include the repository in your `composer.json` file as below:
```
"repositories": [
    {
      "type": "git",
    	"url": "https://github.com/poupouxios/facade-api"
	}
]
```

* In your `config\app.php` append the below lines in the providers array in a new row:
```
...
  FacadeApi\Providers\LaravelServiceProvider::class,
  FacadeApi\Providers\ApiWrapperServiceProvider::class
...
```
* On the same file, append the below lines in the aliases array:
```
...
  'ApiWrapper' => FacadeApi\Facades\ApiWrapper::class
...
```
* If you are using Environment variables, set the `API_CONTAINER_NAME` to be your base url.
* If you want to override the config of the specific package, create a new config called `facadeapi.php` and copy paste anything that is inside `config/config.php` inside the package.
* That should be enough to enable the `ApiWrapper` facade. The call will be:
```
  //ApiWrapper::call(<http-verb>,<route>,<data>);
  $response = ApiWrapper::call("post",'auth/login',["StaffId" => $identifier]);
  ...
```

## Lumen Usage

* Include the repository in your `composer.json` file as below:
```
"repositories": [
    {
      "type": "vcs",
    	"url": "https://github.com/poupouxios/facade-api"
	}
]
```

* In your `bootstrap\app.php` append the below lines under the providers section:
```
...
  $app->register(FacadeApi\Providers\LaravelServiceProvider::class);
  $app->register(FacadeApi\Providers\ApiWrapperServiceProvider::class);
...
```
* On the same file, uncomment the `$app->withFacades();` line to enable the Facades and below of it add the below line:
```
class_exists('ApiWrapper') or class_alias(FacadeApi\Facades\ApiWrapper::class, 'ApiWrapper');
```
* If you are using Environment variables, set the `API_CONTAINER_NAME` to be your base url.
* If you want to override the config of the specific package, create a new config called `facadeapi.php` and copy paste anything that is inside `config/config.php` inside the package.
* That should be enough to enable the `ApiWrapper` facade. The call will be:
```
  //ApiWrapper::call(<http-verb>,<route>,<data>);
  $response = ApiWrapper::call("post",'auth/login',["StaffId" => $identifier]);
  ...
```

## Improvements

* Need to set the HttpHandler to be injected in the Facade so you can set your own HttpHandler by following the `ClientHandlerInterface` structure.
