Yii2 Anno
=========
Better step-by-step guides for powerful web apps

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ak868308/yii2-anno "*"
```

or add

```
"ak868308/yii2-anno": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \ak868308\anno\Anno::widget([
        'var' => 'anno1',
        'triggerOnLoad' => TRUE,
        'oneTime' => TRUE,
        'pluginOptions' => [
            [
                'target' => '#element1',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s',
                'position' => 'left',
                'className' => 'anno-width-200', // 150,175,200,250 (default 300)
                'buttons' => [ak868308\anno\Anno::NEXT_BUTTON]
            ],
            [
                'target' => '#element2',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s',
                'position' => 'left'
            ],
            
        ]
    ]); ?>```
