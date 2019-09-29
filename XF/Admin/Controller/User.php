<?php

namespace West\ColorUsername\XF\Admin\Controller;

class User extends XFCP_User
{
	protected function userSaveProcess(\XF\Entity\User $user)
    {
        $form = parent::userSaveProcess($user);

        /** @var \West\ColorUsername\XF\Entity\User $user*/
        $form->setup(function () use ($user)
        {
            $input = $this->filter([
                'w_cu_type' => 'str',
                'w_cu_color' => 'str',
                'w_cu_color_second' => 'str'
            ]);

            $user->setUsernameColor($input['w_cu_type'], $input['w_cu_color'], $input['w_cu_color_second']);
        });

        return $form;
    }
}