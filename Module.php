<?php
namespace EmojiModule;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'emojimodule_emoji_service' => 'EmojiModule\Service\Emoji',
            ),
            'factories' => array(
                'emojimodule_emoji_maps' => function ($sm) {
                    $config = $sm->get('Config');
                    return (isset($config['emojimodule']['emoji_maps']) ? $config['emojimodule']['emoji_maps']: array());
                },
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'emoji' => 'EmojiModule\View\Helper\Emoji',
            ),
        );
    }
}