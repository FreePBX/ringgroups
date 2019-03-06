<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
	public function runRestore(){
		$configs = $this->getConfigs();
		foreach($configs['groups'] as $rg) {
			$this->FreePBX->Ringgroups->delete($rg['grpnum'])
			->add(
				$rg['grpnum'],
				$rg['strategy'],
				$rg['grptime'],
				$rg['grplist'],
				$rg['postdest'],
				$rg['description'],
				$rg['grppre'],
				$rg['annmsg_id'],
				$rg['alertinfo'],
				$rg['needsconf'],
				$rg['remotealert_id'],
				$rg['toolate_id'],
				$rg['ringing'],
				$rg['cwignore'],
				$rg['cfignore'],
				$rg['changecid'],
				$rg['fixedcid'],
				$rg['cpickup'],
				$rg['recording'],
				$rg['progress'],
				$rg['elsewhere'],
				$rg['rvolume']
			);
		}
		$this->importAdvancedSettings($configs['settings']);
	}

	public function processLegacy($pdo, $data, $tables, $unknownTables){
		$this->restoreLegacyDatabase($pdo);
		$this->restoreLegacyAdvancedSettings($pdo);
	}
}
