SELECT 
  `Queue`.*, 
  `Owner`.`Description` AS 'OwnerDescription'
FROM `Queue`
  LEFT JOIN `Owner` ON `Queue`.`idOwner` = `Owner`.`idOwner` 