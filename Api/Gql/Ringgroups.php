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
					'addRingGroup' => Relay::mutationWithClientMutationId([
						'name' => 'addRingGroup',
						'description' => _('Add a new Ringgroup'),
						'inputFields' => $this->getMutationFields(),
						'outputFields' => $this->getOutputFields(),
						'mutateAndGetPayload' => function ($input) {
							$res = $this->addRingGroup($input);
							if(isset($res) && $res == true){
								return ['message' => _("Successfully added ringgroup"), 'status'=> true];
							}else{
								return ['message' => _("Sorry,Ringgroup already exists"), 'status' => false];
							}
						}
					]),
					'updateRingGroup' => Relay::mutationWithClientMutationId([
						'name' => 'updateRingGroup',
						'description' => _('Update a ringgroup'),
						'inputFields' => $this->getMutationUpdateFields(),
						'outputFields' => $this->getOutputFields(),
						'mutateAndGetPayload' => function ($input) {
							$res = $this->freepbx->Ringgroups->getExtensionLists($input['groupNumber']);
							if(empty($res))
								return ['message' =>_("Sorry, unable to find the Ringgroup"), 'status' => false];

							$list = $this->freepbx->Ringgroups->getAllGroups();
						   $item = array_search($input['groupNumber'], array_column($list,'grpnum'));
							$response = $this->freepbx->Ringgroups->delete($input['groupNumber']);
							if(isset($response) && is_int($item)){
								$this->updateRingGroup($input,$list[$item]);
								return ['message' => _("RingGroup updated Successfully"), 'status'=> true];
							}else{
								return ['message' => _("Sorry, unable to process your update request"),'status' => false];
							}
						}
					]),
					'deleteRingGroup' => Relay::mutationWithClientMutationId([
						'name' => 'DeleteRingGroup',
						'description' => _('Delete a ringgroup'),
						'inputFields' => [
							'groupNumber' => [
								'type' => Type::nonNull(Type::int())
							]
						],
						'outputFields' => $this->getOutputFields(),
						'mutateAndGetPayload' => function ($input) {
							$response = $this->freepbx->Ringgroups->delete($input['groupNumber']);
							if(isset($response)){
								return ['message' => _("Successfully deleted ringgroup"), 'status'=> true];
							}else{
								return ['message' => _("Sorry, unable to process your delete request"),'status' => false];
							}
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
					'fetchAllRingGroups' => [
						'type' => $this->typeContainer->get('ringgroup')->getConnectionType(),
						'description' => _('Use to get all the ringgroups'),
						'args' => Relay::connectionArgs(),
						'resolve' => function($root, $args) {
							$list = Relay::connectionFromArray($this->freepbx->Ringgroups->getAllGroups(), $args);
							if(isset($list) && $list != null){
								return ['response'=> $list,'status'=>true];
							}else{
								return ['message'=> _("Sorry, unable to find any ringgroup"),'status' => false];
							}
						},
					],
					'fetchRingGroup' => [
						'type' => $this->typeContainer->get('ringgroup')->getObject(),
						'args' => [
							'groupNumber' => [
								'type' => Type::id(),
								'description' => _('The Ringgroup number to search for'),
							]
						],
						'resolve' => function($root, $args) {
							$list = $this->freepbx->Ringgroups->getAllGroups();
						   $item = array_search($args['groupNumber'], array_column($list,'grpnum'));
							if(is_int($item)){
								$list[$item]['status'] = true;
								$list[$item]['message'] = _("Record found successfully");
								return $list[$item];
							}else{
								$list[$item]['status'] = false;
								$list[$item]['message'] = _("Sorry, unable to find any ringgroup");
								return $list[$item];
							}
						}
					],
				];
			};
		}
	}

	public function initializeTypes() {
		$ringgroups = $this->typeContainer->create('ringgroup');
		$ringgroups->setDescription(_('Used to set ringgroup values'));

		$ringgroups->addInterfaceCallback(function() {
			return [$this->getNodeDefinition()['nodeInterface']];
		});

		$ringgroups->setGetNodeCallback(function($id) {
			$list = $this->freepbx->Ringgroups->getAllGroups();
			$item = array_search($id, array_column($list, 'number'));
			return isset($list[$item]) ? $list[$item] : null;
		});

		$ringgroups->addFieldCallback(function() {
			return [
				'id' => Relay::globalIdField('ringgroup', function($row) {
					return $row['grpnum'];
				}),
				'groupNumber' => [
					'type' => Type::int(),
					'description' => _('A Ringgroup number'),
					'resolve' => function($row) {
						return isset($row['grpnum']) ? $row['grpnum'] : null;
					}
				],
				'description' => [
					'type' => Type::string(),
					'description' => _('A descriptive title for this Ringgroup')
				],
				'groupList' => [
					'type' => Type::string(),
					'description' => _('Extensions to ring, one per line'),
					'resolve' => function($row) {
						return isset($row['grplist']) ? $row['grplist'] : null;
					}
				],
				'groupTime' => [
					'type' => Type::int(),
					'description' => _('Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung'),
					'resolve' => function($row) {
						return isset($row['grptime']) ? $row['grptime'] : null;
					}
				],
				'groupPrefix' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['grppre']) ? $row['grppre'] : null;
					}
				],
				'needConf' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['needsconf']) ? $row['needsconf'] : null;
					}
				],
				'overrideRingerVolume' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['rvolume']) ? $row['rvolume'] : null;
					}
				],
				'changecid' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['changecid']) ? $row['changecid'] : null;
					}
				],
				'fixedcid' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['fixedcid']) ? $row['fixedcid'] : null;
					}
				],
				'callRecording' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['recording']) ? $row['recording'] : null;
					}
				],
				'pickupCall' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						if(isset($row['cpickup'])){
							return $this->validate($row['cpickup']);
						}else{
							return null;
						}
					}
				],
				'callProgress' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						if(isset($row['progress']) && $row['progress'] == 'yes'){
							return true;
						}
						else{
							return false;
						}
					}
				],
				'answeredElseWhere' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						if(isset($row['elsewhere']) && $row['elsewhere'] == 'yes'){
							return true;
						}
						else{
							return false;
						}
					}
				],
				'ignoreCallForward' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						if(isset($row['cfignore'])){
							return $this->validate($row['cfignore']);
						}else{
							return null;
						}
					}
				],
				'ignoreCallWait' => [
					'type' => Type::boolean(),
					'description' => _(''),
					'resolve' => function($row) {
						if(isset($row['cwignore'])){
							return $this->validate($row['cwignore']);
						}else{
							return null;
						}
					}
				],
				'alertInfo' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['alertinfo']) ? $row['alertinfo'] : null;
					}
				],
				'recevierMessageConfirmCall' => [
					'type' => Type::string(),
					'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessageConfirmCall instead.'),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['remotealert_id']) ? $row['remotealert_id'] : null;
					}
				],
				'recevierMessage' => [
					'type' => Type::string(),
					'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessage instead.'),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['toolate_id']) ? $row['toolate_id'] : null;
					}
				],
				'receiverMessageConfirmCall' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['remotealert_id']) ? $row['remotealert_id'] : null;
					}
				],
				'receiverMessage' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['toolate_id']) ? $row['toolate_id'] : null;
					}
				],
				'postAnswer' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['postdest']) ? $row['postdest'] : null;
					}
				],
				'callerMessage' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['annmsg_id']) ? $row['annmsg_id'] : null;
					}
				],
				'ringingMusic' => [
					'type' => Type::string(),
					'description' => _(''),
					'resolve' => function($row) {
						return isset($row['ringing']) ? $row['ringing'] : null;
					}
				],
				'strategy' => [
					'type' => new EnumType([
						'name' => 'ringstrategies',
						'description' => _('Ring Strategies'),
						'values' => [
							'ringall' => [
								'value' => 'ringall',
								'description' => _('Ring all available channels until one answers (default)')
							],
							'ringallprim' => [
								'value' => 'ringall-prim',
								'description' => _("Ring all available channels until one answers. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung")
							],
							'hunt' => [
								'value' => 'hunt',
								'description' => _('Take turns ringing each available extension')
							],
							'huntprim' => [
								'value' => 'hunt-prim',
								'description' => _("Take turns ringing each available extension. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung")
							],
							'memoryhunt' => [
								'value' => 'memoryhunt',
								'description' => _('Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc')
							],
							'memoryhuntprim' => [
								'value' => 'memoryhunt-prim',
								'description' => _("Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc. If the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung")
							],
							'firstavailable' => [
								'value' => 'firstavailable',
								'description' => _('Ring only the first available channel')
							],
							'firstnotonphone' => [
								'value' => 'firstnotonphone',
								'description' => _('Ring only the first channel which is not offhook - ignore CW')
							]
						]
					]),
					'description' => _('Ring Strategy')
				],
				'message' =>[
					'type' => Type::string(),
					'description' => _('Message for the request')
				],
				'status' =>[
					'type' => Type::boolean(),
					'description' => _('Status for the request')
				]
			];
		});

		$ringgroups->setConnectionResolveNode(function ($edge) {
			return $edge['node'];
		});

		$ringgroups->setConnectionFields(function() {
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
						},$root['response']['edges']);
						   return $data;
					}
				],
				'message' =>[
					'type' => Type::string(),
					'description' => _('Message for the request')
				],
				'status' =>[
					'type' => Type::boolean(),
					'description' => _('Status for the request')
				]
			];
		});
	}

	private function getMutationFields() {
		return [
			'groupNumber' => [
				'type' => Type::nonNull(Type::id()),
				'description' => _('RingGroup number')
			],
			'description' => [
				'type' => Type::string(),
				'description' => _('Enter a description for this ringgroup.')
			],
			'strategy' => [
				'type' => Type::nonNull(Type::string()),
				'description' => _('Ringing Strategy')
			],
			'extensionList' => [
				'type' => Type::nonNull(Type::string()),
				'description' => _('Extensions to ring, seperated by -')
			],
			'ringTime' => [
				'type' => Type::string(),
				'description' => _('Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung')
			],
			'groupPrefix' => [
				'type' => Type::string(),
				'description' => _('You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring.')
			],
			'callerMessage' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the caller before dialing this group.')
			],
			'postAnswer' => [
				'type' => Type::string(),
				'description' => _('Where to send callers if there is no answer.')
			],
			'alertInfo' => [
				'type' => Type::string(),
				'description' => _('Alert info can be used for distinctive ring with SIP devices.')
			],
			'needConf' => [
				'type' => Type::boolean(),
				'description' => _('Enable this if you\'re calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy')
			],
			'recevierMessageConfirmCall' => [
				'type' => Type::string(),
				'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessageConfirmCall instead.'),
				'description' => _('DEPRECATED: Use receiverMessageConfirmCall instead. Message to be played to the person RECEIVING the call, if \'Confirm Calls\' is enabled.')
			],
			'recevierMessage' => [ 
				'type' => Type::string(),
				'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessage instead.'),
				'description' => _('DEPRECATED: Use receiverMessage instead. Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.')
			],
			'receiverMessageConfirmCall' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if \'Confirm Calls\' is enabled.')
			],
			'receiverMessage' => [ 
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.')
			],
			'ringingMusic' => [
				'type' => Type::string(),
				'description' => _('If you select a music to play on hold, instead of \'Ring\', they will hear that instead of Ringing while they are waiting for someone to pick up.')
			],
			'ignoreCallForward' => [ 
				'type' => Type::boolean(),
				'description' => _('When set to true, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with \'#\' at the end, for example to access the extension\'s Follow-Me, might not honor this setting .')
			],
			'ignoreCallWait' => [
				'type' => Type::boolean(),
				'description' => _('When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted.')
			],
			'pickupCall' => [
				'type' => Type::boolean(),
				'description' => _('When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number from any extension. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup by dialing the group number. Any extensions can still be picked up by doing a directed call pickup to the ringing extension , which works whether or not this is checked.')
			],
			'callRecording' => [
				'type' => Type::string(),
				'description' => _('You can always record calls that come into this ringgroup (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). ')
			],
			'callProgress' => [
				'type' => Type::boolean(),
				'description' => _('Should this ringgroup indicate call progress to digital channels where supported.(true/false)')
			],
			'answeredElseWhere' => [
				'type' => Type::boolean(),
				'description' => _('Should calls indicate answered elsewhere when a user answers.(true/false)')
			],
			'overrideRingerVolume' => [
				'type' => Type::string(),
				'description' => _('Override the ringer volume. Note: This is only valid for Sangoma phones at this time')
			],
			'changecid' => [
				'type' => Type::string(),
				'description' => _('Change External CID Configuration.')
			],
			'fixedcid' => [
				'type' => Type::string(),
				'description' => _("Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'.")
			],
		];
	}
	
	/**
	 * getMutationUpdateFields
	 *
	 * @return void
	 */
	private function getMutationUpdateFields() {
		return [
			'groupNumber' => [
				'type' => Type::nonNull(Type::id()),
				'description' => _('RingGroup number')
			],
			'description' => [
				'type' => Type::string(),
				'description' => _('Enter a description for this ringgroup.')
			],
			'strategy' => [
				'type' => Type::string(),
				'description' => _('Ringing Strategy')
			],
			'extensionList' => [
				'type' => Type::string(),
				'description' => _('Extensions to ring, seperated by -')
			],
			'ringTime' => [
				'type' => Type::string(),
				'description' => _('Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung')
			],
			'groupPrefix' => [
				'type' => Type::string(),
				'description' => _('You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring.')
			],
			'callerMessage' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the caller before dialing this group.')
			],
			'postAnswer' => [
				'type' => Type::string(),
				'description' => _('Where to send callers if there is no answer.')
			],
			'alertInfo' => [
				'type' => Type::string(),
				'description' => _('Alert info can be used for distinctive ring with SIP devices.')
			],
			'needConf' => [
				'type' => Type::boolean(),
				'description' => _('Enable this if you\'re calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy')
			],
			'recevierMessageConfirmCall' => [
				'type' => Type::string(),
				'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessageConfirmCall instead.'),
				'description' => _('DEPRECATED: Use receiverMessageConfirmCall instead. Message to be played to the person RECEIVING the call, if \'Confirm Calls\' is enabled.')
			],
			'recevierMessage' => [ 
				'type' => Type::string(),
				'deprecationReason' => _('Deprecated due to misspelling. Use receiverMessage instead.'),
				'description' => _('DEPRECATED: Use receiverMessage instead. Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.')
			],
			'receiverMessageConfirmCall' => [
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if \'Confirm Calls\' is enabled.')
			],
			'receiverMessage' => [ 
				'type' => Type::string(),
				'description' => _('Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.')
			],
			'ringingMusic' => [
				'type' => Type::string(),
				'description' => _('If you select a music to play on hold, instead of \'Ring\', they will hear that instead of Ringing while they are waiting for someone to pick up.')
			],
			'ignoreCallForward' => [ 
				'type' => Type::boolean(),
				'description' => _('When set to true, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with \'#\' at the end, for example to access the extension\'s Follow-Me, might not honor this setting .')
			],
			'ignoreCallWait' => [
				'type' => Type::boolean(),
				'description' => _('When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted.')
			],
			'pickupCall' => [
				'type' => Type::boolean(),
				'description' => _('When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number from any extension. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup by dialing the group number. Any extensions can still be picked up by doing a directed call pickup to the ringing extension , which works whether or not this is checked.')
			],
			'callRecording' => [
				'type' => Type::string(),
				'description' => _('You can always record calls that come into this ringgroup (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). ')
			],
			'callProgress' => [
				'type' => Type::boolean(),
				'description' => _('Should this ringgroup indicate call progress to digital channels where supported.(true/false)')
			],
			'answeredElseWhere' => [
				'type' => Type::boolean(),
				'description' => _('Should calls indicate answered elsewhere when a user answers.(true/false)')
			],
			'overrideRingerVolume' => [
				'type' => Type::string(),
				'description' => _('Override the ringer volume. Note: This is only valid for Sangoma phones at this time')
			],
			'changecid' => [
				'type' => Type::string(),
				'description' => _('Change External CID Configuration.')
			],
			'fixedcid' => [
				'type' => Type::string(),
				'description' => _("Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'.")
			],
		];
	}

	public function getOutputFields(){
		return [
			'status' => [
			'type' => Type::boolean(),
			'resolve' => function ($payload) {
				return $payload['status'];
				}
			],
			'message' => [
			'type' => Type::string(),
				'resolve' => function ($payload) {
				return $payload['message'];
				}
			],
			'response' => [
				'type' => $this->typeContainer->get('ringgroup')->getObject(),
				'resolve' => function ($payload) {
					return $payload['ringgroup'];
				}
			]
		];
	}

	private function addRingGroup($input){

		$grpnum = $input['groupNumber'];
		$strategy = isset($input['strategy']) ? $input['strategy'] : 'ringall';
		$grptime = isset($input['ringTime']) ? $input['ringTime'] : 20;
		$grppre = isset($input['groupPrefix']) ? $input['groupPrefix'] : 'ringall';
		$grplist = isset($input['extensionList']) ? $input['extensionList'] : '';
		$annmsg_id = isset($input['callerMessage']) ? $input['callerMessage'] : 0;
		$postdest = isset($input['postAnswer']) ? $input['postAnswer'] : 'app-blackhole,hangup,1';
		$desc = isset($input['description']) ? $input['description'] : 'ring group'.$grpnum;
		$alertinfo = isset($input['alertInfo']) ? $input['alertInfo'] : '';
		$needsconf = (isset($input['needConf']) && $input['needConf'] == true) ?  'CHECKED' : '';
		$remotealert_id = isset($input['receiverMessageConfirmCall']) ? $input['receiverMessageConfirmCall'] : 0;
		$toolate_id = isset($input['receiverMessage']) ? $input['receiverMessage'] : 0;

		// Ongoing support of deprecated misspelling
		if ($remotealert_id === 0 && isset($input['recevierMessageConfirmCall'])) {
			$remotealert_id = $input['recevierMessageConfirmCall'];
		}

		// Ongoing support of deprecated misspelling
		if ($toolate_id === 0 && isset($input['recevierMessage'])) {
			$toolate_id = $input['recevierMessage'];
		}

		$ringing = isset($input['ringingMusic']) ? $input['ringingMusic'] : 'Ring';
		$cwignore = (isset($input['ignoreCallWait']) && $input['ignoreCallWait'] == true) ? 'CHECKED' : '';
		$cfignore = (isset($input['ignoreCallForward']) && $input['ignoreCallForward'] == true) ? 'CHECKED' : '';
		$cpickup = (isset($input['pickupCall']) && $input['pickupCall'] == true) ? 'CHECKED' : '';
		$recording = isset($input['callRecording']) ? $input['callRecording'] : 'dontcare';
		$progress = (isset($input['callProgress']) &&  $input['callProgress'] == true) ? 'yes' : 'no';
		$elsewhere = (isset($input['answeredElseWhere']) && $input['answeredElseWhere'] == true) ? 'yes' : 'no';
		$rvolume = isset($input['overrideRingerVolume']) ? $input['overrideRingerVolume'] : '';
		$changecid = isset($input['changecid']) ? $input['changecid'] : "default";
		if(!in_array($changecid,array("fixed","extern","did","forcedid"))) {
			$changecid = "default";
		}
		$fixedcid = isset($input['fixedcid']) ? $input['fixedcid'] : "";
		
		return $this->freepbx->Ringgroups->add($grpnum,$strategy,$grptime,$grplist,$postdest,$desc,$grppre,$annmsg_id,$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore,$changecid,$fixedcid,$cpickup, $recording,$progress,$elsewhere,$rvolume,1);
	}
		
	/**
	 * updateRingGroup
	 *
	 * @param  mixed $input
	 * @return void
	 */
	private function updateRingGroup($input,$res){
		$grpnum = $input['groupNumber'];
		$strategy = isset($input['strategy']) ? $input['strategy'] : $res['strategy'];
		$grptime = isset($input['ringTime']) ? $input['ringTime'] : $res['grptime'];
		$grppre = isset($input['groupPrefix']) ? $input['groupPrefix'] : $res['grppre'];
		$grplist = isset($input['extensionList']) ? $input['extensionList'] : $res['grplist'];
		$annmsg_id = isset($input['callerMessage']) ? $input['callerMessage'] : $res['annmsg_id'];
		$postdest = isset($input['postAnswer']) ? $input['postAnswer'] :  $res['postdest'];
		$desc = isset($input['description']) ? $input['description'] : $res['desc'];
		$alertinfo = isset($input['alertInfo']) ? $input['alertInfo'] : $res['alertinfo'];
		$needsconf = isset($input['needConf']) ? $input['needConf'] : $res['needsconf'];
		$remotealert_id = isset($input['receiverMessageConfirmCall']) ? $input['receiverMessageConfirmCall'] : $res['remotealert_id'];
		$toolate_id = isset($input['receiverMessage']) ? $input['receiverMessage'] : $res['toolate_id'];

		// Ongoing support of deprecated misspelling
		if ($remotealert_id === $res['remotealert_id'] && isset($input['recevierMessageConfirmCall'])) {
			$remotealert_id = $input['recevierMessageConfirmCall'];
		}

		// Ongoing support of deprecated misspelling
		if ($toolate_id === $res['toolate_id'] && isset($input['recevierMessage'])) {
			$toolate_id = $input['recevierMessage'];
		}

		$ringing = isset($input['ringingMusic']) ? $input['ringingMusic'] : $res['ringing'];
		$cwignore = isset($input['ignoreCallWait']) ? $input['ignoreCallWait'] : $res['cwignore'];
		$cfignore = isset($input['ignoreCallForward']) ? $input['ignoreCallForward']: $res['cfignore'];
		$cpickup = isset($input['pickupCall']) ? $input['pickupCall'] : $res['cpickup'];
		$recording = isset($input['callRecording']) ? $input['callRecording'] : $res['recording'];
		$progress = isset($input['callProgress']) ?  $input['callProgress'] : $res['progress'];
		$elsewhere = isset($input['answeredElseWhere']) ? $input['answeredElseWhere'] : $res['elsewhere'];
		$rvolume = isset($input['overrideRingerVolume']) ? $input['overrideRingerVolume'] : $res['rvolume'];

		$changecid = isset($input['changecid']) ? $input['changecid'] : $res['changecid'];
		if(!in_array($changecid,array("fixed","extern","did","forcedid"))) {
			$changecid = "default";
		}
		$fixedcid = isset($input['fixedcid']) ? $input['fixedcid'] : $res['fixedcid'];
		
		return $this->freepbx->Ringgroups->add($grpnum,$strategy,$grptime,$grplist,$postdest,$desc,$grppre,$annmsg_id,$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore,$changecid,$fixedcid,$cpickup, $recording,$progress,$elsewhere,$rvolume,1);
	}

	/**
	 * validate
	 *
	 * @param  mixed $row
	 * @return boolean
	 */
	private function validate($row){
		if($row == 'CHECKED'){
			return true;
		}
		else{
			return false;
		}
	}
}
