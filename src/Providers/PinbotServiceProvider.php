<?php 
namespace Kaankilic\Pinbot\Providers;
use Illuminate\Support\ServiceProvider;

class PinbotServiceProvider extends ServiceProvider {
	protected $defer = false;

	public function boot(\Illuminate\Routing\Router $router){
		$this->publishes([
			__DIR__.'/../../config/pinbot.php' => config_path('pinbot.php')
			]);
		$this->app->bind('Pinbot', 'Kaankilic\Pinbot\Factories\PinterestBot' );
	}
	public function register(){
		$this->mergeConfigFrom(__DIR__ . '/../../config/pinbot.php', 'pinbot');
		return array('Pinbot');
	}
}
