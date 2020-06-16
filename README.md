# yii2-wizard
Bootstrap wizard for Yii2

## Usage
```php
echo \soldierm\wizard\Wizard::widget([
    'items' => [
        [
            'label' => 'First',
            'content' => 'This is first page.'
        ],
        [
            'label' => 'Second',
            'content' => 'This is second page.'
        ],
    ],
    'previousBtnName' => 'previous',
    'nextBtnName' => 'next',
]);
```

### View

![image.png](https://upload-images.jianshu.io/upload_images/23781488-b733a0e37881bd8a.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)