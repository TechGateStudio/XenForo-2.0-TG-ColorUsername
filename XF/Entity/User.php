<?php

namespace West\ColorUsername\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * Class User
 * @package West\ColorUsername\XF\Entity
 *
 * @property string w_cu_type
 * @property string w_cu_color
 * @property string w_cu_color_second
 */

class User extends XFCP_User
{
	public function canChangeUsernameColor()
	{
		return ($this->user_id && $this->hasPermission('general', 'w_cu_nick_color'));
	}

	public function getColorUsernameStyles()
    {
        switch ($this->w_cu_type)
        {
            case 'none':
                $styles = null;
                break;
            case 'single':
                $styles = sprintf("color: %s; background: unset;", $this->w_cu_color);
                break;
            case 'gradient':
                $styles = sprintf("background: linear-gradient(to right, %s, %s);
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;", $this->w_cu_color, $this->w_cu_color_second);
                break;
        }

        return $styles;
    }

    public function setUsernameColor($type, $color, $secondColor)
    {
        $this->w_cu_type = $type;
        $this->w_cu_color = $color;
        $this->w_cu_color_second = $secondColor;
    }

    protected function _preSave()
    {
        parent::_preSave();

        switch ($this->w_cu_type)
        {
            case 'single':
                if (!$this->w_cu_color) $this->error(\XF::phrase('w_cu_please_enter_correct_color'));
                break;
            case 'gradient':
                if (!$this->w_cu_color || !$this->w_cu_color_second) $this->error(\XF::phrase('w_cu_please_enter_correct_color'));
                break;
        }
    }

    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns += [
            'w_cu_type' => ['type' => self::STR, 'allowedValues' => ['none', 'single', 'gradient'], 'default' => 'none'],
            'w_cu_color' => ['type' => self::STR, 'nullable' => true],
            'w_cu_color_second' => ['type' => self::STR, 'nullable' => true]
        ];

        return $structure;
    }
}