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

        if (!$user) return $parent;

        /** @var \West\ColorUsername\XF\Entity\User $user */
        $styles = $user->getColorUsernameStyles();

        if ($styles)
        {
            $search = 'data-xf-init="member-tooltip"';
            $parent = str_replace('class="username"', 'class="username username--colored"', $parent);
            $parent = str_replace($search, $search . " style=\"$styles\"", $parent);
        }

        return $parent;
    }
}