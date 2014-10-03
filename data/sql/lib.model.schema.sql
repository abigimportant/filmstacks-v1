
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- fs_stacks
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_stacks`;


CREATE TABLE `fs_stacks`
(
	`stack_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`word_id` INTEGER,
	`group_id` INTEGER,
	`stack_seen_count` INTEGER,
	`stack_watchdate` DATE  NOT NULL,
	`stack_recommend` TINYINT  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`stack_id`),
	INDEX `fs_stacks_FI_1` (`film_id`),
	CONSTRAINT `fs_stacks_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `fs_films` (`film_id`),
	INDEX `fs_stacks_FI_2` (`user_id`),
	CONSTRAINT `fs_stacks_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `fs_stacks_FI_3` (`word_id`),
	CONSTRAINT `fs_stacks_FK_3`
		FOREIGN KEY (`word_id`)
		REFERENCES `fs_stacks_words` (`word_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_stacks_groups
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_stacks_groups`;


CREATE TABLE `fs_stacks_groups`
(
	`group_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`stack_id` INTEGER  NOT NULL,
	`group_user_ids` TEXT,
	PRIMARY KEY (`group_id`),
	INDEX `fs_stacks_groups_FI_1` (`stack_id`),
	CONSTRAINT `fs_stacks_groups_FK_1`
		FOREIGN KEY (`stack_id`)
		REFERENCES `fs_stacks` (`stack_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_stacks_comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_stacks_comments`;


CREATE TABLE `fs_stacks_comments`
(
	`stack_comment_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`stack_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`stack_comment_comment` VARCHAR(180)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`stack_comment_id`),
	INDEX `fs_stacks_comments_FI_1` (`stack_id`),
	CONSTRAINT `fs_stacks_comments_FK_1`
		FOREIGN KEY (`stack_id`)
		REFERENCES `fs_stacks` (`stack_id`),
	INDEX `fs_stacks_comments_FI_2` (`user_id`),
	CONSTRAINT `fs_stacks_comments_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_stacks_words
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_stacks_words`;


CREATE TABLE `fs_stacks_words`
(
	`word_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`word_word` VARCHAR(32)  NOT NULL,
	`word_value` INTEGER  NOT NULL,
	PRIMARY KEY (`word_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_films
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_films`;


CREATE TABLE `fs_films`
(
	`film_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_title` VARCHAR(64)  NOT NULL,
	`film_wikipedia_title` VARCHAR(64)  NOT NULL,
	`film_wikipedia_poster` VARCHAR(256),
	`film_wikipedia_summary` TEXT,
	`film_release` DATE  NOT NULL,
	`film_wikipedia_revision` INTEGER,
	`next_sync` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`film_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_films_reviews
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_films_reviews`;


CREATE TABLE `fs_films_reviews`
(
	`review_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`review_content` TEXT  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`review_id`),
	INDEX `fs_films_reviews_FI_1` (`film_id`),
	CONSTRAINT `fs_films_reviews_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `fs_films` (`film_id`),
	INDEX `fs_films_reviews_FI_2` (`user_id`),
	CONSTRAINT `fs_films_reviews_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_films_reviews_comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_films_reviews_comments`;


CREATE TABLE `fs_films_reviews_comments`
(
	`review_comment_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`review_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`review_comment_id`),
	INDEX `fs_films_reviews_comments_FI_1` (`review_id`),
	CONSTRAINT `fs_films_reviews_comments_FK_1`
		FOREIGN KEY (`review_id`)
		REFERENCES `fs_films_reviews` (`review_id`),
	INDEX `fs_films_reviews_comments_FI_2` (`user_id`),
	CONSTRAINT `fs_films_reviews_comments_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_user_relationships
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_user_relationships`;


CREATE TABLE `fs_user_relationships`
(
	`relationship_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`first_user_id` INTEGER  NOT NULL,
	`second_user_id` INTEGER  NOT NULL,
	`relationship_status` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`relationship_id`),
	INDEX `fs_user_relationships_FI_1` (`first_user_id`),
	CONSTRAINT `fs_user_relationships_FK_1`
		FOREIGN KEY (`first_user_id`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `fs_user_relationships_FI_2` (`second_user_id`),
	CONSTRAINT `fs_user_relationships_FK_2`
		FOREIGN KEY (`second_user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`user_email` VARCHAR(128),
	`user_about` VARCHAR(128),
	`user_country` VARCHAR(128),
	`user_first_name` VARCHAR(32),
	`user_last_name` VARCHAR(32),
	`user_twitter_uname` VARCHAR(32),
	`user_twitter_pword` VARCHAR(32),
	`user_twitter_bool` INTEGER default 0,
	`user_avatar_file` VARCHAR(128),
	`user_dob` DATE,
	`user_privacy_level` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `sf_guard_user_profile_FI_1` (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- fs_beta_invitations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fs_beta_invitations`;


CREATE TABLE `fs_beta_invitations`
(
	`invite_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`invite_code` VARCHAR(16),
	`invite_allowance` INTEGER default 20,
	`invite_used` INTEGER default 0,
	PRIMARY KEY (`invite_id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
