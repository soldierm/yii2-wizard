<?php

namespace soldierm\wizard;

use soldierm\wizard\exception\MissingArgumentException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class Wizard extends Widget
{
    /**
     * 设置
     *
     * @var array
     */
    public $options = [];

    /**
     * 元素
     * [
     *   'label' => 'One',
     *   'content' => 'Anim pariatur cliche...'
     * ]
     *
     * @var array
     */
    public $items = [];

    /**
     * 回退按钮
     *
     * @var string
     */
    public $previousBtnName = 'previous';

    /**
     * 前进按钮
     *
     * @var string
     */
    public $nextBtnName = 'next';

    /**
     * @var string
     */
    private $content;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (!$this->items || !is_array($this->items)) {
            throw new MissingArgumentException('items设置错误');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->handleOptions();

        $this->setHeader();
        $this->setContent();
        $this->setFooter();

        WizardAsset::register($this->getView());
        $this->getView()->registerJs('$("div#' . $this->options['id'] . '").bootstrapWizard({});', View::POS_READY);

        echo Html::tag('div', $this->content, $this->options);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleOptions()
    {
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'basic-wizard';
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'basicWizard';
        }
    }

    /**
     * 生成头部
     */
    protected function setHeader()
    {
        $labelArray = ArrayHelper::getColumn($this->items, 'label');
        $liArray = [];
        foreach ($labelArray as $key => $label) {
            $li = '<a href="#tab' . ($key + 1) . '" data-toggle="tab"><span>Step ' . ($key + 1) . ':</span> ' . $label . '</a>';
            $options = [];
            if (isset($this->items[$key]['active']) && $this->items[$key]['active'] === true) {
                $options = ['class' => "active"];
            }
            $liArray[$key] = $li;
        }
        $this->content = Html::ul($liArray, ['class' => 'nav nav-pills nav-justified', 'encode' => false]);
    }

    /**
     * 生成内容部分
     */
    protected function setContent()
    {
        $contentArray = ArrayHelper::getColumn($this->items, 'content');
        $content = '';
        foreach ($contentArray as $key => $item) {
            $content .= Html::tag('div', $item, [
                'id' => 'tab' . ($key + 1),
                'class' => 'tab-pane',
            ]);
        }
        $this->content .= Html::tag('div', $content, ['class' => 'tab-content']);
    }

    /**
     * 生成底部按钮
     */
    protected function setFooter()
    {
        $footer = Html::tag('li', Html::a($this->previousBtnName, 'javascript:void(0)'), ['class' => 'previous disabled']);
        $footer .= Html::tag('li', Html::a($this->nextBtnName, 'javascript:void(0)'), ['class' => 'next']);

        $this->content .= Html::tag('ul', $footer, ['class' => 'pager wizard']);
    }
}