<?php 

namespace FreepPBX\ringgroup\utests;

require_once('../api/utests/ApiBaseTestCase.php');

use FreePBX\modules\ringgroup;
use Exception;
use FreePBX\modules\Api\utests\ApiBaseTestCase;

class RinggroupGqlApiTest extends ApiBaseTestCase {
    protected static $ringgroup;
    
    public static function setUpBeforeClass() {
      parent::setUpBeforeClass();
      self::$ringgroup = self::$freepbx->Ringgroups;
    }
    
    public static function tearDownAfterClass() {
      parent::tearDownAfterClass();
    }
  
   public function testAddRingGroupWhenRequiredParametersSentShouldReturnTrue(){

      $groupNumber = 908282;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = "ringall";

      //delete existing group
      self::$ringgroup->delete($groupNumber);

       //add new group using gql
       $response = $this->request("mutation {
         addRingGroup(input: { groupNumber: $groupNumber 
            description: \"$description\" 
            extensionList: \"$extensionList\" 
            strategy: \"$strategy\" 

         }) {
          message status 
         }
      }");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"data":{"addRingGroup":{"message":"Successfully added ringgroup","status":true}}}',$json);

      //status 200 success check
      $this->assertEquals(200, $response->getStatusCode());
   }

   public function testAddRingGroupWhenRequiredParametersNotSentShouldReturnFalse(){

      $groupNumber = 908282;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = "ringall";

       //required filed groupnumber is not been sent
       $response = $this->request("mutation {
           addRingGroup(input: {
            description: \"$description\" 
            extensionList: \"$extensionList\" 
            strategy: \"$strategy\" 
         }) {
          message status 
         }
      }");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"errors":[{"message":"Field addRingGroupInput.groupNumber of required type ID! was not provided.","status":false}]}',$json);

      //status 400 failure check
      $this->assertEquals(400, $response->getStatusCode());
   }

   public function testDeleteRingGroupWhenRequiredParametersSentShouldReturnTrue(){

      $groupNumber = 908282;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = $grptime = "ringall";

      //delete ring group
       self::$ringgroup->delete($groupNumber);

      //add ring group
      self::$ringgroup->add($groupNumber,$strategy,$grptime,$extensionList,'app-blackhole,hangup,1',$description,20,0,'','CHECKED',0, 0,'Ring','CHECKED','CHECKED','default','','CHECKED','dontcare','yes','yes','',1);
    
       //delete group using gql
       $response = $this->request("mutation{
         deleteRingGroup(input:{ groupNumber: $groupNumber }) {
            message status
         } }");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"data":{"deleteRingGroup":{"message":"Successfully deleted ringgroup","status":true}}}',$json);

       //status 200 success check
      $this->assertEquals(200, $response->getStatusCode());
   }

    public function testFetchRingwhenRingGroupExistsShouldReturnTrue(){

      $groupNumber = 908383;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = $grptime = "ringall";

      //delete ring group
       self::$ringgroup->delete($groupNumber);

      //add ring group
      self::$ringgroup->add($groupNumber,$strategy,$grptime,$extensionList,'app-blackhole,hangup,1',$description,20,0,'','CHECKED',0, 0,'Ring','CHECKED','CHECKED','default','','CHECKED','dontcare','yes','yes','',1);
    
       //fetch a group using gql
       $response = $this->request("{fetchRingGroup(groupNumber: \"$groupNumber\") { 
          status 
          message 
          groupNumber 
          description
          strategy
         }}");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"data":{"fetchRingGroup":{"status":true,"message":"Record found successfully","groupNumber":'.$groupNumber.',"description":"'.$description.'","strategy":"'.$strategy.'"}}}',$json);
   
       //status 200 success check
      $this->assertEquals(200, $response->getStatusCode());

       //delete ring group which as just created 
       self::$ringgroup->delete($groupNumber);
   }

   public function testFetchRingwhenRingGroupDoesNotExistsShouldReturnFalse(){

      $groupNumber = 908383;

      //delete ring group if exists
       self::$ringgroup->delete($groupNumber);

       //delete group using gql
       $response = $this->request("{fetchRingGroup(groupNumber: \"$groupNumber\") { 
          status message
         }}");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"errors":[{"message":"Sorry, unable to find any ringgroup","status":false}]}',$json);

      //status 400 failure check
      $this->assertEquals(400, $response->getStatusCode());
   }

   public function testRingGroupUpdateWhenExtensionDoesNotExistShouldReturnFalse(){
      $groupNumber = 908383;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = "ringall";

      //delete ring group if exists
      self::$ringgroup->delete($groupNumber);

      $response = $this->request("mutation{updateRingGroup(input:{
         groupNumber: $groupNumber 
         description: \"$description\" 
         extensionList: \"$extensionList\" 
         strategy: \"$strategy\" 
         ringTime: \"30\"
         groupPrefix: \"sales:\"
         needConf:true
         ignoreCallForward:true
         ignoreCallWait:true
         pickupCall:true
         callRecording:\"never\"
         callProgress:true
         answeredElseWhere:true
         overrideRingerVolume:\"20\"
      }
      ){ 
          status message
      }}");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"errors":[{"message":"Sorry, unable to find the Ringgroup","status":false}]}',$json);

      //status 400 failure check
      $this->assertEquals(400, $response->getStatusCode());
   }

   public function testRingGroupUpdateWhenExtensionExistShouldReturnTrue(){
      $groupNumber = 908383;
      $extensionList = "100-101";
      $description = "testgroup";
      $strategy = $grptime = "ringall";

      //delete ring group if exists
      self::$ringgroup->delete($groupNumber);

      //create an ringgroup to update 
      self::$ringgroup->add($groupNumber,$strategy,$grptime,$extensionList,'app-blackhole,hangup,1',$description,20,0,'','CHECKED',0, 0,'Ring','CHECKED','CHECKED','default','','CHECKED','dontcare','yes','yes','',1);

      $response = $this->request("mutation{updateRingGroup(input:{
         groupNumber: $groupNumber 
         description: \"$description\" 
         extensionList: \"$extensionList\" 
         strategy: \"$strategy\" 
         ringTime: \"25\"
         groupPrefix: \"sales:\"
         needConf:true
         ignoreCallForward:false
         ignoreCallWait:false
         pickupCall:false
         callRecording:\"never\"
         callProgress:false
         answeredElseWhere:true
         overrideRingerVolume:\"25\"
      }
      ){ 
          status message
      }}");
      
      $json = (string)$response->getBody();

      $this->assertEquals('{"data":{"updateRingGroup":{"status":true,"message":"RingGroup updated Successfully"}}}',$json);

      //status 200 success check
      $this->assertEquals(200, $response->getStatusCode());
   }
}