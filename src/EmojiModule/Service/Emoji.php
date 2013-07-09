<?php
namespace EmojiModule\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Emoji implements ServiceLocatorAwareInterface
{
    /**
     * @var array
     */
    protected $unifiedToVariables = null;

    /**
     * @var array
     */
    protected $variablesToUnified = null;

    /**
     * @var array
     */
    protected $variablesToHtml = null;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Unified to variables
     *
     * @param  string $text
     * @return string
     */
    public function unifiedToVariables($text)
    {
        $unifiedToVariables = $this->getUnifiedToVariables();
        return str_replace(array_keys($unifiedToVariables), $unifiedToVariables, $text);
    }

    public function variablesToHtml($text)
    {
        $variablesToHtml = $this->getVariablesToHtml();
        return str_replace(array_keys($variablesToHtml), $variablesToHtml, $text);
    }

    /**
     * Variables to unified
     *
     * @param  string $text
     * @return string
     */
    public function variablesToUnified($text)
    {
        $variablesToUnified = $this->getVariablesToUnified();
        return str_replace(array_keys($variablesToUnified), $variablesToUnified, $text);
    }

    /**
     * Get unified to variables
     *
     * @return array
     */
    public function getUnifiedToVariables()
    {
        if ($this->unifiedToVariables === null) {
            $this->setUnifiedToVariables($this->getServiceLocator()->get('emojimodule_emoji_maps'));
        }
        return $this->unifiedToVariables;
    }

    /**
     * Set unified to variables
     *
     * @param  array $unifiedToVariables
     * @return $this
     */
    public function setUnifiedToVariables(array $unifiedToVariables)
    {
        $this->unifiedToVariables = $unifiedToVariables;
        return $this;
    }

    /**
     * Get variable to html
     *
     * @return array
     */
    public function getVariablesToHtml()
    {
        if ($this->variablesToHtml === null) {
            $variablesToHtml = array();
            foreach ($this->getUnifiedToVariables() as $variable) {
                if ($match = preg_match('/^#(.+?)#$/', $variable, $matches)) {
                    $code = $matches[1];
                    $variablesToHtml[$variable] = sprintf('<span class="emoji emoji%s">', $code);
                }
            }
            $this->variablesToHtml = $variablesToHtml;
        }
        return $this->variablesToHtml;
    }

    /**
     * Set variables to html
     *
     * @param  array $variablesToHtml
     * @return Emoji
     */
    public function setVariablesToHtml(array $variablesToHtml)
    {
        $this->variablesToHtml = $variablesToHtml;
        return $this;
    }

    /**
     * Get variables to unified
     *
     * @return array
     */
    public function getVariablesToUnified()
    {
        if ($this->variablesToUnified === null) {
            $this->setEmojiVariables(array_flip($this->getUnifiedToVariables()));
        }
        return $this->variablesToUnified;
    }

    /**
     * Set variables to unified
     *
     * @param  array $variablesToUnified
     * @return Emoji
     */
    public function setVariablesToUnified(array $variablesToUnified)
    {
        $this->variablesToUnified = $variablesToUnified;
        return $this;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}