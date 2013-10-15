<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection */
//			'db'=>array(
//				'connectionString'=>'sqlite:'.dirname(__FILE__).'/../data/demoyii.db',
//			),
                    'db'=>array(
 			'connectionString' => 'mysql:host=127.0.0.1;dbname=yiitest;port=3306',
 			'emulatePrepare' => true,
 			'username' => 'root',
 			'password' => 'root',
 			'charset' => 'utf8',
 		),
			
		),
	)
);
