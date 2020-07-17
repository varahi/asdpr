#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	note text,
	contribution varchar(255) DEFAULT '' NOT NULL,
	tgi int(11) unsigned DEFAULT '0',
	appeal int(11) unsigned DEFAULT '0',

	tx_extbase_type varchar(255) DEFAULT '' NOT NULL

);

#
# Table structure for table 'tx_andprmembers_domain_model_location'
#
CREATE TABLE tx_andprmembers_domain_model_location (

	name varchar(255) DEFAULT '' NOT NULL,
	description text

);
