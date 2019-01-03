<?php

namespace West\ColorUsername\XF\Entity;

class User extends XFCP_User
{
	public function canChangeUsernameColor()
	{
		return ($this->user_id && $this->hasPermission('general', 'w_cu_nick_color'));
	}
}