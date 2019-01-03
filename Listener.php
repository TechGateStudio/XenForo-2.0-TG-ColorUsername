<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 03.01.2019
 * Time: 15:06
 * Made with <3 by West from TechGate Studio
 */

namespace West\ColorUsername;


use XF\Mvc\Entity\Entity;

class Listener
{
	public static function userEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
	{
		$structure->columns['w_cu_type'] = ['type' => Entity::STR, 'allowedValues' => ['none', 'single', 'gradient'], 'default' => 'none'];
		$structure->columns['w_cu_color'] = ['type' => Entity::STR, 'nullable' => true];
		$structure->columns['w_cu_color_second'] = ['type' => Entity::STR, 'nullable' => true];
	}
}