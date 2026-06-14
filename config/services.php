<?php
/**
 * Service wiring. Returns a closure that registers every service in the
 * container. Bindings are lazy; admin services are guarded by is_admin().
 *
 * @package Sizer
 */

declare(strict_types=1);

use Sizer\Admin\Assignment;
use Sizer\Admin\SettingsPage;
use Sizer\Container;
use Sizer\Migrator;
use Sizer\Repository\ChartRepository;
use Sizer\Service\ChartResolver;
use Sizer\Service\Settings;
use Sizer\Service\SizeGuideService;
use Sizer\Util\TemplateLoader;

defined('ABSPATH') || exit;

return static function (Container $c): void {
    $c->singleton(Migrator::class, static fn (): Migrator => new Migrator());

    $c->singleton(ChartRepository::class, static fn (): ChartRepository => new ChartRepository());
    $c->singleton(Settings::class, static fn (): Settings => new Settings());
    $c->singleton(TemplateLoader::class, static fn (): TemplateLoader => new TemplateLoader());

    $c->singleton(
        ChartResolver::class,
        static fn (): ChartResolver => new ChartResolver($c->get(ChartRepository::class)),
    );

    $c->singleton(
        SizeGuideService::class,
        static fn (): SizeGuideService => new SizeGuideService(
            $c->get(Settings::class),
            $c->get(ChartResolver::class),
            $c->get(TemplateLoader::class),
        ),
    );

    if (is_admin()) {
        $c->singleton(
            SettingsPage::class,
            static fn (): SettingsPage => new SettingsPage(
                $c->get(Settings::class),
                $c->get(ChartRepository::class),
            ),
        );

        $c->singleton(
            Assignment::class,
            static fn (): Assignment => new Assignment(
                $c->get(ChartRepository::class),
            ),
        );
    }
};
