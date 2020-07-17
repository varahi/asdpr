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
	appeal int(11) unsigned DEFAULT '0'

);

#
# Table structure for table 'tx_andprmembers_domain_model_tgi'
#
CREATE TABLE tx_andprmembers_domain_model_tgi (

	name varchar(255) DEFAULT '' NOT NULL,
	description text

);

#
# Table structure for table 'tx_andprmembers_domain_model_appeal'
#
CREATE TABLE tx_andprmembers_domain_model_appeal (

	name varchar(255) DEFAULT '' NOT NULL,
	description text

);
