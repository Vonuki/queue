SELECT 
	`Item`.*, 
  `Queue`.`Description` AS 'QueueDescription', 
  `Owner`.`Description` AS 'OwnerDescription'
FROM `Item`
  LEFT JOIN `Owner` ON `Item`.`idClient` = `Owner`.`idOwner` 
  LEFT JOIN `Queue` ON `Item`.`idQueue` = `Queue`.`idQueue`