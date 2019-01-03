<?php

namespace West\ColorUsername;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
	{
		$this->schemaManager()->alterTable('xf_user', function (Alter $table)
		{
			$table->addColumn('w_cu_type', 'enum')->values(['none', 'single', 'gradient'])->setDefault('none');
			$table->addColumn('w_cu_color', 'text')->nullable();
			$table->addColumn('w_cu_color_second', 'text')->nullable();
		});
	}

	public function uninstallStep1()
	{
		$this->schemaManager()->alterTable('xf_user', function (Alter $table)
		{
			$table->dropColumns(['w_cu_type', 'w_cu_color', 'w_cu_color_second']);
		});
	}
}