<?php

	$steamID = array
	('76561198419123469');

	$titles = array('SteamID', '#', 'assetid', 'classid', 'Наименование', 'Качество', 'Коллекция', 'Тип', 'Оружие', 'Категория', 'Редкость', 'Турнир', 'Команды', 'Профессиональный игрок', 'Коллекция наклеек', 'Цвет граффити', 'Коллекция граффити');
	$categories = array ('Exterior', 'ItemSet', 'Type', 'Weapon', 'Quality', 'Rarity', 'Tournament', 'TournamentTeam', 'ProPlayer', 'StickerCapsule', 'SprayColorCategory', 'SprayCapsule');
	$counter = 1;
	
	echo '<pre>';
	echo '<table border="1">';
	echo '<tr>';
	foreach ($titles as $value)
	{
		echo '<td>';
		echo $value;
		echo '</td>';
	}
	echo '</tr>';
	
	foreach ($steamID as $value)
		{	
			$inventoryJsonUrl = 'http://steamcommunity.com/inventory/'.$value.'/730/2?l=russian&count=5000';
			$currentSteamID = $value;
			$inventoryJsonGet = file_get_contents($inventoryJsonUrl);
			$inventories = json_decode($inventoryJsonGet , TRUE);
	
			foreach ($inventories['assets'] as $key => $assetid)
				{
					echo '<tr>';
					echo '<td>';
					echo $currentSteamID;
					echo '</td>';
					echo '<td>';
					echo $counter++;
					echo '</td>';
					echo '<td>';
					echo $assetid["assetid"];
					echo '</td>';
					echo '<td>';
					echo $assetid["classid"];
					echo '</td>';
					foreach ($inventories['descriptions'] as $key => $description)
						{
							if ($assetid["classid"] == $description['classid'])
								{
									//Наименование
									echo '<td>';
									echo $description['name'];
									echo '</td>';
									foreach ($categories as $value)
										{
											echo '<td>';
											for ($x=0; $x<10; $x++)
												{
													if ($description['tags'][$x]['category'] == $value)
														{
															echo $description['tags'][$x]['localized_tag_name'];
														}
												}
								echo '</td>';
							}
						}
					}
				echo '</tr>';
	
		}
	}
	echo '</table>';
	echo '<pre>';
?>
