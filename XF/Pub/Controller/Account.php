<?php

namespace West\ColorUsername\XF\Pub\Controller;

class Account extends XFCP_Account
{
	protected function accountDetailsSaveProcess(\XF\Entity\User $visitor)
	{
		$form = parent::accountDetailsSaveProcess($visitor);

		if ($visitor->canChangeUsernameColor())
		{
			$form->setup(function() use($visitor)
			{
				$visitor->w_cu_type = $this->filter('w_cu_type', 'str');
				$visitor->w_cu_color = $this->filter('w_cu_color', 'str');

				$visitor->w_cu_color_second = $this->filter('w_cu_color_second', 'str');

				if(($visitor->w_cu_type == 'gradient' AND (!$visitor->w_cu_color_second OR !$visitor->w_cu_color)) OR ($visitor->w_cu_type == 'single' AND !$visitor->w_cu_color))
				{
					throw $this->exception($this->error(\XF::phraseDeferred('w_cu_please_enter_correct_color')));
				}
				
			});
		}
		return $form;
	}
}