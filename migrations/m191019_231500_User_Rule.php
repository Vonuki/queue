<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_231500_User_Rule extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
      $this->execute('

		INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
		("QueueOwnerRule", 0x4f3a33303a226170705c6d6f64656c735c726261635c51756575654f776e657252756c65223a333a7b733a343a226e616d65223b733a31343a2251756575654f776e657252756c65223b733a393a22637265617465644174223b693a313537313532313231383b733a393a22757064617465644174223b693a313537313532313231383b7d, 1571521218, 1571521218);

		INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
		("admin", 1, "system admin", NULL, NULL, 1571521854, 1571690775),
		("genuser", 1, "general user", NULL, NULL, 1571521661, 1571524447),
		("grantQueue", 2, "Full access for Queue", NULL, NULL, 1571688682, 1571688682),
		("manageOwnQueue", 2, "for owner of queue", "QueueOwnerRule", NULL, 1571521821, 1571688642),
		("manageQueue", 2, "manage Queue access", NULL, NULL, 1571521614, 1571688607);
		
		INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
		("admin", "grantQueue"),
		("genuser", "manageOwnQueue"),
		("admin", "manageQueue"),
		("manageOwnQueue", "manageQueue");
		
		INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
		(1, "admin", "mail@mail.com", "$2y$10$jvZ7cz7YGynjLWf/hKjEce0eqDAZtsc.TNsYp8C09.LO6B6aqs84C", "8iPrHS5L-Dh0Ve0sTf30u8DpDtP1ifPi", 1561662050, NULL, NULL, "194.246.46.15", 1561641238, 1561641238, 0, 1572795458);

		INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
		("admin", "1", 1571523010);
		
		INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
		(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

      ');
    }

    public function safeDown()
    {
    }
}
