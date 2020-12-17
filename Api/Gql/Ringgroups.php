<?php

namespace FreePBX\modules\Ringgroups\Api\Gql;

use GraphQLRelay\Relay;
use GraphQL\Type\Definition\Type;
use FreePBX\modules\Api\Gql\Base;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\EnumType;
class Ringgroups extends Base {
	protected $module = 'ringgroups';

	public function mutationCallback() {
		if($this->checkAllWriteScope()) {
			return function() {
				return [
					'addRinggroup' => Relay::mutationWithClientMutationId([
						'name' => 'addRinggroup',
						'description' => 'Add a new Ringgroup',
						'inputFields' => $this->getMutationFields(),
						'outputFields' => [
							'ringgroup' => [
								'type' => $this->typeContainer->get('ringgroup')->getObject(),
								'resolve' => function ($payload) {
									return $payload;
								}
							]
						],
						'mutateAndGetPayload' => function ($input) {
							$grpnum =$input['grpnum'];
							$strategy = isset($input['strategy']) ? $input['strategy'] : 'ringall';
							$grptime = isset($input['grptime']) ? $input['grptime'] : 'ringall';
							$grppre = isset($input['strategy']) ? $input['strategy'] : 20;
							$grplist= isset($input['grplist']) ? $input['grplist'] : '';
							$annmsg_id =  isset($input['annmsg_id']) ? $input['annmsg_id'] : 0;
							$postdest = isset($input['postdest']) ? $input['postdest'] : 'app-blackhole,hangup,1';
							$desc = isset($input['desc']) ? $input['desc'] : 'ring group'.$grpnum;
							$alertinfo = isset($input['alertinfo']) ? $input['alertinfo'] : '';
							if(isset($input['needsconf']) && strtolower($input['needsconf'])=='yes' ){$needsconf = 'CHECKED';} else {$needsconf = '';}
							$remotealert_id = isset($input['remotealert_id']) ? $input['remotealert_id'] : 0;
							$toolate_id = isset($input['toolate_id']) ? $input['toolate_id'] : 0;
							$ringing = isset($input['ringing']) ? $input['ringing'] : 'Ring';
							if(isset($input['cwignore']) && strtolower($input['cwignore'])=='yes' ){$cwignore = 'CHECKED'; } else {$cwignore = '';}
							if(isset($input['cfignore']) && strtolower($input['cfignore'])=='yes' ){$cfignore = 'CHECKED'; } else {$cfignore = '';}
							if(isset($input['cpickup']) && strtolower($input['cpickup'])=='yes' ){$cpickup = 'CHECKED'; } else {$cpickup = '';}
							$recording = isset($input['recording']) ? $input['recording'] : 'dontcare';
							$progress = isset($input['progress']) ? $input['progress'] : 'no';
							$elsewhere = isset($input['elsewhere']) ? $input['elsewhere'] : 'no';
							$rvolume = isset($input['rvolume']) ? $input['rvolume'] : '';
							$this->freepbx->Ringgroups->add($grpnum,$strategy,$grptime,$grplist,$postdest,$desc,$grppre='',$annmsg_id='0',$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore,$changecid='default',$fixedcid='',$cpickup='', $recording='dontcare',$progress='yes',$elsewhere,$rvolume);
							$list = $this->freepbx->Ringgroups->getAllGroups(true);
							$item = array_search($input['grpnum'], array_column($list, 'grpnum'));
							return isset($list[$item]) ? $list[$item] : null;
						}
					]),
					'removeringgroup' => Relay::mutationWithClientMutationId([
						'name' => 'removeRingGroup',
						'description' => 'Remove a ring group',
						'inputFields' => [
							'grpnum' => [
								'type' => Type::nonNull(Type::int())
							]
						],
						'outputFields' => [
							'deletedId' => [
								'type' => Type::nonNull(Type::id()),
								'resolve' => function ($payload) {
									return $payload['grpnum'];
								}
							]
						],
						'mutateAndGetPayload' => function ($input) {
							$this->freepbx->Ringgroups->delete($input['grpnum']);
							return ['id' => $input['grpnum']];
						}
					])
				];
			};
		}
	}

	public function queryCallback() {
		if($this->checkAllReadScope()) {
			return function() {
				return [
					'allringgroups' => [
						'type' => $this->typeContainer->get('ringgroup')->getConnectionType(),
						'description' => 'Used to manage a system wide list of blocked callers',
						'args' => Relay::connectionArgs(),
						'resolve' => function($root, $args) {
							return Relay::connectionFromArray($this->freepbx->Ringgroups->getAllGroups(), $args);
						},
					],
					'ringgroup' => [
						'type' => $this->typeContainer->get('ringgroup')->getObject(),
						'args' => [
							'id' => [
								'type' => Type::id(),
								'description' => 'The ID',
							]
						],
						'resolve' => function($root, $args) {
							$list = $this->freepbx->Ringgroups->getAllGroups();
							$item = array_search(Relay::fromGlobalId($args['id'])['id'], array_column($list, 'grpnum'));
							return isset($list[$item]) ? $list[$item] : null;
						}
					],
				];
			};
		}
	}

	public function initializeTypes() {
		$user = $this->typeContainer->create('ringgroup');
		$user->setDescription('Used to manage a system wide list of blocked callers');

		$user->addInterfaceCallback(function() {
			return [$this->getNodeDefinition()['nodeInterface']];
		});

		$user->setGetNodeCallback(function($id) {
			$list = $this->freepbx->Ringgroups->getAllGroups();
			$item = array_search($id, array_column($list, 'number'));
			return isset($list[$item]) ? $list[$item] : null;
		});

		$user->addFieldCallback(function() {
			return [
				'id' => Relay::globalIdField('ringgroup', function($row) {
					return $row['grpnum'];
				}),
				'grpnum' => [
					'type' => Type::int(),
					'description' => 'A Ring Group number'
				],
				'description' => [
					'type' => Type::string(),
					'description' => 'A descriptive title for this Ring Group'
				],
				'grplist' => [
					'type' => Type::string(),
					'description' => 'extensions to ring, one per line'
				],
				'grptime' => [
					'type' => Type::int(),
					'description' => 'Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung'
				],
				'strategy' => [
					'type' => new EnumType([
						'name' => 'ringstrategies',
						'description' => 'Ring Strategies',
						'values' => [
							'ringall' => [
								'value' => 'ringall',
								'description' => 'Ring all available channels until one answers (default)'
							],
							'ringallprim' => [
								'value' => 'ringall-prim',
								'description' => "Ring all available channels until one answers. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung"
							],
							'hunt' => [
								'value' => 'hunt',
								'description' => 'Take turns ringing each available extension'
							],
							'huntprim' => [
								'value' => 'hunt-prim',
								'description' => "Take turns ringing each available extension. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung"
							],
							'memoryhunt' => [
								'value' => 'memoryhunt',
								'description' => 'Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc'
							],
							'memoryhuntprim' => [
								'value' => 'memoryhunt-prim',
								'description' => "Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung"
							],
							'firstavailable' => [
								'value' => 'firstavailable',
								'description' => 'Ring only the first available channel'
							],
							'firstnotonphone' => [
								'value' => 'firstnotonphone',
								'description' => 'Ring only the first channel which is not offhook - ignore CW'

							]
						]
					]),
					'description' => 'Ring Strategy'
				],
				
			];
		});

		$user->setConnectionResolveNode(function ($edge) {
			return $edge['node'];
		});

		$user->setConnectionFields(function() {
			return [
				'totalCount' => [
					'type' => Type::int(),
					'resolve' => function($value) {
						return count($this->freepbx->Ringgroups->getAllGroups());
					}
				],
				'ringgroups' => [
					'type' => Type::listOf($this->typeContainer->get('ringgroup')->getObject()),
					'resolve' => function($root, $args) {
						$data = array_map(function($row){
							return $row['node'];
						},$root['edges']);
						return $data;
					}
				]
			];
		});
	}

	private function getMutationFields() {
		return [
			'grpnum' => [
				'type' => Type::nonNull(Type::id()),
				'description' => _('RingGroup number')
			],
			'desc' => [
				'type' => Type::string(),
				'description' => _('Enter a description for this ringgroup.')
			],
			'strategy' => [
				'type' => Type::nonNull(Type::string()),
				'description' => _('Ring Strategy')
			],
			'grplist' => [
				'type' => Type::nonNull(Type::string()),
				'description' => _('extensions to ring, seperated by -')
			],
			'grptime' => [
				'type' => Type::string(),
				'description' => _('Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung')
			],
			'grppre' => [
				'type' => Type::int(),
				'description' => _('You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring.')
			],
			'annmsg_id' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the caller before dialing this group.')
			],
			'postdest' => [
				'type' => Type::string(),
				'description' => 'Where to send callers if there is no answer.'
			],
			'alertinfo' => [
				'type' => Type::string(),
				'description' => 'ALERT_INFO can be used for distinctive ring with SIP devices.'
			],
			'needsconf' => [
				'type' => Type::string(),
				'description' => _('Enable this if you\'re calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy')
			],
			'remotealert_id' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if \'Confirm Calls\' is enabled.')
			],
			'toolate_id' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.')
			],
			'ringing' => [
				'type' => Type::string(),
				'description' => _('If you select a Music on Hold class to play, instead of \'Ring\', they will hear that instead of Ringing while they are waiting for someone to pick up.')
			],
			'cfignore' => [
				'type' => Type::string(),
				'description' => _('When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with \'#\' at the end, for example to access the extension\'s Follow-Me, might not honor this setting .')
			],
			'cwignore' => [
				'type' => Type::string(),
				'description' => _('When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted.')
			],
			'cpickup' => [
				'type' => Type::string(),
				'description' => _('When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number from any extension. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup by dialing the group number. Any extensions can still be picked up by doing a directed call pickup to the ringing extension , which works whether or not this is checked.')
			],
			'recording' => [
				'type' => Type::string(),
				'description' => _('You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). ')
			],
			'progress' => [
				'type' => Type::string(),
				'description' => 'Should this ringgroup indicate call progress to digital channels where supported.(yes/no)'
			],
			'elsewhere' => [
				'type' => Type::string(),
				'description' => 'Should calls indicate answered elsewhere when a user answers.(yes/no)'
			],
			'rvolume' => [
				'type' => Type::string(),
				'description' => 'Override the ringer volume. Note: This is only valid for Sangoma phones at this time'
			],
			
		];
	}

}
