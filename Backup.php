<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
  public function runBackup($id,$transaction){
    $ringroupList = $this->FreePBX->Ringgroups->listRinggroups(true);
    $configs = [];
    foreach ($ringroupList as $rg) {
        $config = $this->FreePBX->Ringgroups->get($rg['grpnum']);
        $configs[] = $config[0];
    }
    $this->addDirectories($dirs);
    $this->addDependency('core');
    $this->addDependency('callrecordings');
    $this->addConfigs($configs);
  }
}