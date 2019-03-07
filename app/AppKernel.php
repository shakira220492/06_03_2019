<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new HomeBundle\HomeBundle(),
            new VideoBundle\VideoBundle(),
            new ConfigurationBundle\ConfigurationBundle(),
            new MediaBundle\MediaBundle(),
            new ArtistBundle\ArtistBundle(),
            new ListBundle\ListBundle(),
            new DataminingBundle\DataminingBundle(),
//            new CreateBundle\CreateBundle(),
            new SearchengineBundle\SearchengineBundle(),
//            new UploadBundle\UploadBundle(),
            new PremiumBundle\PremiumBundle(),
            new PlayBannerBundle\PlayBannerBundle(),
            new PresentationBundle\PresentationBundle(),
            new SessionBundle\SessionBundle(),
            new OptionsBundle\OptionsBundle(),
            new HistoryBundle\HistoryBundle(),
            new CacheBundle\CacheBundle(),
            new UploadVideoBundle\UploadVideoBundle(),
            new SongBundle\SongBundle(),
            new CommentVideoBundle\CommentVideoBundle(),
            new EditProfileBundle\EditProfileBundle(),
            new FollowerBundle\FollowerBundle(),
            new FollowingBundle\FollowingBundle(),
            new EditVideoBundle\EditVideoBundle(),
            new UserReportsBundle\UserReportsBundle(),
            new PaypalBundle\PaypalBundle(),
            new EditLyricsBundle\EditLyricsBundle(),
            new ShowLyricsBundle\ShowLyricsBundle(),
            new PayUBundle\PayUBundle(),
            new DeleteVideoBundle\DeleteVideoBundle(),
            new EditInformationVideoBundle\EditInformationVideoBundle(),
            new PromoteVideoBundle\PromoteVideoBundle(),
            new AdvertisingVideoBundle\AdvertisingVideoBundle(),
            new DeclineDeleteVideoBundle\DeclineDeleteVideoBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir() {
        return __DIR__;
    }

    public function getCacheDir() {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir() {
        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('container.autowiring.strict_mode', true);
            $container->setParameter('container.dumper.inline_class_loader', true);

            $container->addObjectResource($this);
        });
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function __construct($environment, $debug) {
        date_default_timezone_set('America/Bogota');
        parent::__construct($environment, $debug);
    }

}
