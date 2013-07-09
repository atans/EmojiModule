EmojiModule for Zend Framework 2
================================

Introduction
------------
A sample emoji module for Zend Framework 2

1.`😁Hello World` to :smile:
2.`😁Hello World` to `#1f601# Hello World` (You can save it to MySQL < 5.5)
3.`#1f601# Hello World` to `😁Hello World`
4.`😁Hello World` to `<span class="emoji emoji1f601"></span> Hello World`
5.`#1f601# Hello World` to `<span class="emoji emoji1f601"></span> Hello World`


Installation
------------

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "atans/emoji-module": "dev-master"
    }
    ```

2. Running this command

  ```bash
  $ php composer.phar update
  ```

#### Post installation

    ```php
    <?php
      return array(
        'modules' => array(
          // ...
          'EmojiModule',
        ),
      );
    ```

3. Call `emojimodule_emoji_service` in a controller

    ```php
    $emojiService = $this->getServiceLocator()->get('emojimodule_emoji_service');
    $text = "\xF0\x9F\x98\x81 Hello World";
    $variables = $emojiService->encode($text);    // Output: #1f601# Hello World (You can save it to MySQL now)

    // Variables restore to unified
    $unified = $emojiService->decode($variables); // Output: \xF0\x9F\x98\x81 Hello World

    // Variables to Html
    $variablesToHtml = $emojiService->variablesToHtml($variables); // Output: <span class="emoji emoji1f601"></span> Hello World

    // Unified to html
    $unifiedToHtml = $emojiService->unifiedToHtml($unified);       // Output: <span class="emoji emoji1f601"></span> Hello World

    return array(
        'unifiedToHtml' => $unifiedToHtml,
    );
    ```

4. View

    copy `https://raw.github.com/iamcal/php-emoji/master/emoji.css` and `https://github.com/iamcal/php-emoji/blob/master/emoji.png`
    to '/public/css/'

    ```php
    // index.phtml
    <?php
    $this->headLink()->appendStylesheet($this->basePath() . '/css/emoji.css');
    ?>

    <?php echo echo $unifiedToHtml ?>
    ``
