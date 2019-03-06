<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
	public function runBackup($id,$transaction){
		$this->addDirectories($dirs);
		$this->addDependency('core');
		$this->addDependency('callrecordings');
		$this->addConfigs([
			'groups' => $this->FreePBX->Database->query('SELECT * FROM ringgroups')->fetchAll(\PDO::FETCH_ASSOC),
			'settings' => $this->dumpAdvancedSettings()
		]);
	}
}