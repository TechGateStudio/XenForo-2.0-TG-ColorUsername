<?php

namespace West\ColorUsername\XF\Pub\Controller;

class Account extends XFCP_Account
{
	protected function accountDetailsSaveProcess(\XF\Entity\User $visitor)
	{
		$form = parent::accountDetailsSaveProcess($visitor);

		/** @var \West\ColorUsername\XF\Entity\User $visitor */
		if ($visitor->canChangeUsernameColor())
		{
			$form->setup(function() use ($visitor)
			{
                $input = $this->filter([
                    'w_cu_type' => 'str',
                    'w_cu_color' => 'str',
                    'w_cu_color_second' => 'str'
                ]);

                $visitor->setUsernameColor($input['w_cu_type'], $input['w_cu_color'], $input['w_cu_color_second']);
			});
		}

		return $form;
	}
}