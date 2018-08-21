<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
  public function runRestore($jobid){
    $configs = reset($this->getConfigs());
    if (!empty($configs)) {
        foreach ($configs as $rg) {
            $this->FreePBX->Ringgroups->delete($rg['grpnum'])
                ->add($rg['grpnum'], $rg['strategy'], $rg['grptime'], $rg['grplist'], $rg['postdest'], $rg['description'], $rg['grppre'], $rg['annmsg_id'], $rg['alertinfo'], $rg['needsconf'], $rg['remotealert_id'], $rg['toolate_id'], $rg['ringing'], $rg['cwignore'], $rg['cfignore'], $rg['changecid'], $rg['fixedcid'], $rg['cpickup'], $rg['recording'], $rg['progress'], $rg['elsewhere'], $rg['rvolume']);
        }
    }
  } 

  public function processLegacy($pdo, $data, $tables, $unknownTables, $tmpfiledir){
    $tables = array_flip($tables+$unknownTables);
    if(!isset($tables['rawname'])){
      return $this;
    }
    $bmo = $this->FreePBX->Ringgroups;
    $bmo->setDatabase($pdo);
    $ringroupList = $cb->listRinggroups(true);
    $configs = [];
    foreach ($ringroupList as $rg) {
      $config = $cb->get($rg['grpnum']);
      $configs[] = $config[0];
    }
    $bmo->resetDatabase();
    $configs = reset($configs);
    foreach ($configs as $rg) {
      $this->FreePBX->Ringgroups->delete($rg['grpnum'])
        ->add($rg['grpnum'], $rg['strategy'], $rg['grptime'], $rg['grplist'], $rg['postdest'], $rg['description'], $rg['grppre'], $rg['annmsg_id'], $rg['alertinfo'], $rg['needsconf'], $rg['remotealert_id'], $rg['toolate_id'], $rg['ringing'], $rg['cwignore'], $rg['cfignore'], $rg['changecid'], $rg['fixedcid'], $rg['cpickup'], $rg['recording'], $rg['progress'], $rg['elsewhere'], $rg['rvolume']);
    }
    return $this;
  }
}
