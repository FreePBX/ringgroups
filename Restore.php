<?php
namespace FreePBX\modules\Ringgroups;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
  public function runRestore($jobid){
    $configs = $this->getConfigs();
    foreach ($configd as $rg) {
        $this->FreePBX->Ringgroups->delete($rg['grpnum'])
            ->add($rg['grpnum'], $rg['strategy'], $rg['grptime'], $rg['grplist'], $rg['postdest'], $rg['desc'], $rg['grppre'], $rg['annmsg_id'], $rg['alertinfo'], $rg['needsconf'], $rg['remotealert_id'], $rg['toolate_id'], $rg['ringing'], $rg['cwignore'], $rg['cfignore'], $rg['changecid'], $rg['fixedcid'], $rg['cpickup'], $rg['recording'], $rg['progress'], $rg['elsewhere'], $rg['rvolume']);
    }
  }
}