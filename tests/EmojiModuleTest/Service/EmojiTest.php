<?php
namespace EmojiModuleTest\Service;

use EmojiModule\Service\Emoji as EmojiService;
use PHPUnit_Framework_TestCase;

class EmojiTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EmojiService
     */
    protected $emojiSerivce;

    public function setUp()
    {
        $this->emojiSerivce = new EmojiService();
        $this->emojiSerivce->setUnifiedToVariables(include __DIR__ . '/../../../config/emoji.maps.php');
    }

    public function testEncode()
    {
        $this->assertSame(
            "#1f601# Hello World",
            $this->emojiSerivce->encode("\xF0\x9F\x98\x81 Hello World"),
            "Test encode"
        );
    }

    public function testDecode()
    {
        $this->assertSame(
            "\xF0\x9F\x98\x81 Hello World",
            $this->emojiSerivce->decode("#1f601# Hello World"),
            "Test decode"
        );
    }

    public function testVariablesToHtml()
    {
        $this->assertSame(
            '<span class="emoji emoji1f601"></span> Hello World',
            $this->emojiSerivce->variablesToHtml("#1f601# Hello World"),
            "Test variables to html"
        );
    }

    public function testUnifiedToHtml()
    {
        $this->assertSame(
            '<span class="emoji emoji1f601"></span> Hello World',
            $this->emojiSerivce->unifiedToHtml("\xF0\x9F\x98\x81 Hello World"),
            "Test unified to html"
        );
    }
}