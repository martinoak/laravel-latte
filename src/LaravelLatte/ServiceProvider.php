<?php

declare(strict_types=1);

namespace MarvelousMartin\LaravelLatte;

use Illuminate\Foundation\Application;
use Latte\Engine as Latte;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        // Latte
        $this->app->singleton(Latte::class, function ($app) {
            return $this->createLatte($app);
        });

        // LatteEngine
        $factory = $this->app['view'];
        $factory->addExtension('latte', 'latte', function () {
            return $this->createEngine();
        });
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return \Latte\Engine
     */
    private function createLatte(Application $app): Latte
    {
        $config = $this->app['config'];
        $latte = new Latte();
        $latte->setTempDirectory($config->get('view.compiled'));

        $latte->addExtension(new Extension());

        return $latte;
    }

    /**
     * @return \MarvelousMartin\LaravelLatte\LatteEngine
     */
    private function createEngine(): LatteEngine
    {
        return new LatteEngine($this->app[Latte::class]);
    }
}
