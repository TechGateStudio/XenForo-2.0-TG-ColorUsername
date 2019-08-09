<?php

namespace West\ColorUsername\XF\BbCode\Renderer;

class Html extends XFCP_Html
{
    protected static $usersWithCustomUsername = [];

	public function renderTagUser(array $children, $option, array $tag, array $options)
    {
        $parent = parent::renderTagUser($children, $option, $tag, $options);

        $userId = (int)$option;

        if (empty(self::$usersWithCustomUsername[$userId]))
        {
            $user = \XF::em()->find('XF:User', $userId);
            self::$usersWithCustomUsername[$userId] = $user;
        }
        else
        {
            $user = self::$usersWithCustomUsername[$userId];
        }

        /** @var \West\ColorUsername\XF\Entity\User $user */
        $styles = $user->getColorUsernameStyles();

        $search = 'data-xf-init="member-tooltip"';

        return str_replace($search, " style=\"$styles\"", $parent);
    }
}