EmojiModule for Zend Framework 2
================================

Introduction
------------
A sample emoji module for Zend Framework 2


Installation
-----------

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
3. Call emojimodule_emoji_service in a controller

    ```php
    $emojiService = $this->getServiceLocator()->get('emojimodule_emoji_service');
    $text = "\xF0\x9F\x98\x81 Hello World";
    $variables = $emojiService->encode($text);    // #1f601# Hello World (You save it to MySQL now)

    // Variables restore to unified
    $unified = $emojiService->decode($variables); // \xF0\x9F\x98\x81 Hello World

    // Variables to Html
    $variablesToHtml = $emojiService->variablesToHtml($variables);  // <span class="emoji emoji1f601"></span> Hello World

    // unified to html
    $unifiedToHtml = $emojiService->unifiedToHtml($unified);        // <span class="emoji emoji1f601"></span> Hello World

    ```

