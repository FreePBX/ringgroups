<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
	public function runBackup($id,$transaction){
		$this->addDependency('core');
		$this->addDependency('callrecording');
		$astdbval = $this->FreePBX->astman->database_show("RINGGROUP");
		$astValArr = [];
		foreach ($astdbval as $key => $value) {
			$gdetails = explode("/", (string) $key);
			$astValArr[$gdetails[2]][$gdetails[3]] = $value;
		}
		$allringGroups = $this->FreePBX->Database->query('SELECT * FROM ringgroups')->fetchAll(\PDO::FETCH_ASSOC);
		$rgrps = [];
		foreach ($allringGroups as $rgp) {
			if(array_key_exists($rgp['grpnum'],$astValArr)) {
				$rgp['changecid'] = $astValArr[$rgp['grpnum']]['changecid'] ?? 'default';
				$rgp['fixedcid'] = $astValArr[$rgp['grpnum']]['fixedcid'] ?? '';
			}
			$rgrps[] = $rgp;
		}
		$this->addConfigs([
			'groups' => $rgrps,
			'settings' => $this->dumpAdvancedSettings()
		]);
	}
}
