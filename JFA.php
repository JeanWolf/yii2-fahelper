<?php
namespace jext\fahelper;

use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * helper for font-awesome by Jeen
 *
 * usage:
 * echo JFA::i('user')->size('2x');
 * echo JFA::i('ban')->stackOn('camera');
 *
 * Class JFA
 */
class JFA
{
    private $_options = [];
    private $_name = '';


    public static function i(string $name,array $options = [])
    {
        return self::icon($name, $options);
    }
    public static function icon(string $name,array $options = [])
    {
        return new self($name, $options);
    }
    
    public function __construct(string $name,array $options= [])
    {
        if (empty($name)) {
            throw new InvalidParamException('param $name must be set');
        }
        $this->_name = $name;
        $this->_options = $options;
        if (!isset($this->_options['class'])) {
            $this->_options['class'] = ['fa', 'fa-' . $this->_name];
        } else {
            if (!is_array($this->_options['class'])) {
                $this->_options['class'] = explode(' ', $this->_options['class']);
            }
            $this->addClass('fa')->addClass('fa-'.$this->_name);
        }
    }
    
    public function __toString()
    {
        return $this->render();
    }

    public function render(string $tag = null,string $content = null,array $options = []) : string
    {
        $options = ArrayHelper::merge($this->_options, $options);
        $tag = $tag ? : ArrayHelper::remove($options, 'tag', 'i');
        $content = $content ? : ArrayHelper::remove($options, 'content', '');
        return Html::tag($tag, $content, $options);
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function tag(string $tag = 'i')
    {
        $this->_options['tag'] = $tag;
        return $this;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function content(string $content = '')
    {
        $this->_options['content'] = $content;
        return $this;
    }

    /**
     * @return self
     */
    public function inverse()
    {
        return $this->addClass('fa-inverse');
    }

    /**
     * @param string $value lg | 2x | 3x | 4x | 5x
     * @return self
     */
    public function size(string $value = null)
    {
        if (in_array($value, ['lg', '2x', '3x', '4x', '5x'])) {
            return $this->addClass('fa-' . $value);
        }
        return $this;
    }

    /**
     * @return self
     */
    public function fixedWidth()
    {
        return $this->addClass('fa-fw');
    }

    /**
     * @return self
     */
    public function li()
    {
        return $this->addClass('fa-li');
    }

    /**
     * @return self
     */
    public function border()
    {
        return $this->addClass('fa-border');
    }

    /**
     * @return self
     */
    public function pullLeft()
    {
        return $this->addClass('fa-pull-left');
    }

    /**
     * @return self
     */
    public function pullRight()
    {
        return $this->addClass('fa-pull-left');
    }

    /**
     * @param boolean $step8 use fa-pulse to rotate with 8 steps
     * @return self
     */
    public function spin($step8 = false)
    {
        if ($step8) {
            return $this->addClass('fa-pulse');
        }
        return $this->addClass('fa-spin');
    }

    /**
     * @param string $value 90 | 180 | 270
     * @return self
     */
    public function rotate(string $value = null)
    {
        if (in_array($value, ['90', '180', '270'])) {
            return $this->addClass('fa-rotate-' . $value);
        }
        return $this;
    }

    /**
     * @param string $value horizontal | vertical
     * @return $this
     */
    public function flip($value = 'vertical')
    {
        if (in_array($value, ['horizontal', 'vertical'])) {
            return $this->addClass('fa-flip-' . $value);
        }
        return $this;
    }

    /**
     * @param JFA|string $icon
     * @param string|null $tag
     * @param string|null $content
     * @param array $options
     * @return string
     */
    public function stackOn($icon,string $tag = null,string $content = null,array $options = []):string
    {
        $stackIconName = $icon instanceof JFA ? $icon->_name : $icon;
        $tag = $tag ? : ArrayHelper::remove($options, 'tag', 'span');
        $content = $content ? : ArrayHelper::remove($options, 'content', '');

        $stackOptions = $this->_options;
        $stackClass = ['fa-stack'];
        Html::removeCssClass($stackOptions, ['fa', 'fa-'. $this->_name]);
        Html::addCssClass($stackOptions, $stackClass);
        $html = Html::beginTag('span', $stackOptions);
        $html .= (new self($stackIconName))->addClass('fa-stack-2x')->render();
        $html .= (new self($this->_name))->addClass('fa-stack-1x')->render();
        $html .= Html::endTag('span');

        return Html::tag($tag, ($html . $content), $options);
    }

    /**
     * @param string|array $class
     * @return $this
     */
    private function addClass($class) 
    {
        if (is_string($class) && !in_array($class, $this->_options['class'])) {
            $this->_options['class'][] = $class;
        } elseif (is_array($class)) {
            $this->_options['class'] = ArrayHelper::merge($this->_options['class'], $class);
            $this->_options['class'] = array_unique($this->_options['class']);
        }
        return $this;
    }
}
