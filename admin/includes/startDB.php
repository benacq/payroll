<?php
  include_once '../classes/DefaultData.php';
  include_once '../classes/database/CreateTables.php';
  $tables = new CreateTables();
  $tables->create();
  $defaultData = new DefaultData();
  $defaultData->db_AddGender();
  $defaultData->db_AddMaritalStatus();
  $defaultData->db_AddPosition();
  $defaultData->db_AddHr('Ben','Acq','Arhin',1,34,3,1);

?>