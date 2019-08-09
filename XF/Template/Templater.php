<?php

namespace West\ColorUsername\XF\Template;

class Templater extends XFCP_Templater
{
	public function fnUsernameLink($templater, &$escape, $user, $rich = false, $attributes = [])
	{
		$html = parent::fnUsernameLink($templater, $escape, $user, $rich, $attributes);

		if ($user instanceof \XF\Entity\User)
		{
			if ($user->canChangeUsernameColor())
			{
				if ($user->w_cu_type == 'single')
				{
					$html = str_replace('dir', sprintf('style="color: %s; background: unset;" dir', $user->w_cu_color), $html);
					$html = str_replace('class="','class="username--singleColor', $html);
				}
				if ($user->w_cu_type == 'gradient')
				{
					$html = str_replace('dir', sprintf('
					class="username--gradient"
					style="background: linear-gradient(to right, %s, %s);
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;" dir',
					$user->w_cu_color, $user->w_cu_color_second), $html);
					$html = str_replace('class="', 'class="username--gradient ', $html);
				}
			}
		}
		return $html;
	}
}